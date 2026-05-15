<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\TravelModel;
use App\Models\PemesananModel;
use App\Models\PelangganModel;

class Reservasi extends BaseController
{
    protected $travelModel;
    protected $pemesananModel;
    protected $pelangganModel;

    public function __construct()
    {
        $this->travelModel = new TravelModel();
        $this->pemesananModel = new PemesananModel();
        $this->pelangganModel = new PelangganModel();
    }

    public function index()
    {
        $pelanggan = $this->pelangganModel->where('id_user', session()->get('id_user'))->first();
        
        $data = [
            'title'          => 'Dashboard Pelanggan',
            'total_pesanan'  => $this->pemesananModel->where('id_pelanggan', $pelanggan['id_pelanggan'])->countAllResults(),
            'pesanan_terbaru'=> $this->pemesananModel->where('id_pelanggan', $pelanggan['id_pelanggan'])->orderBy('id_reservasi', 'DESC')->limit(5)->get()->getResultArray(),
        ];

        return view('pelanggan/dashboard', $data);
    }

    public function travel()
    {
        $search = $this->request->getGet('search');
        
        $query = $this->travelModel;
        
        if (!empty($search)) {
            $query->like('nama_mobil', $search);
        }
        
        $data = [
            'title'  => 'Pilih Armada Travel',
            'travel' => $query->findAll(),
            'search' => $search
        ];

        return view('pelanggan/travel', $data);
    }

    public function create($id)
    {
        $travel = $this->travelModel->find($id);
        if (!$travel) {
            return redirect()->to('/pelanggan/travel')->with('error', 'Armada tidak ditemukan.');
        }

        // Get all active bookings for this car
        $activeBookings = $this->pemesananModel
            ->where('id_travel', $id)
            ->whereIn('status_reservasi', ['Pending', 'Dikonfirmasi'])
            ->findAll();
            
        $bookedDates = [];
        foreach ($activeBookings as $booking) {
            $bookedDates[] = [
                'start' => $booking['tgl_mulai'],
                'end'   => $booking['tgl_selesai']
            ];
        }

        return view('pelanggan/reservasi_form', [
            'title'        => 'Form Reservasi',
            'travel'       => $travel,
            'booked_dates' => json_encode($bookedDates)
        ]);
    }

    public function store()
    {
        $rules = [
            'id_travel'   => 'required',
            'tgl_mulai'   => 'required|valid_date',
            'tgl_selesai' => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $travel = $this->travelModel->find($this->request->getPost('id_travel'));
        $pelanggan = $this->pelangganModel->where('id_user', session()->get('id_user'))->first();

        // Hitung durasi dan total bayar
        $tgl_mulai   = $this->request->getPost('tgl_mulai');
        $tgl_selesai = $this->request->getPost('tgl_selesai');

        $tgl1 = new \DateTime($tgl_mulai);
        $tgl2 = new \DateTime($tgl_selesai);
        $durasi = $tgl1->diff($tgl2)->days + 1; // Minimal 1 hari
        
        if ($durasi <= 0) {
            return redirect()->back()->withInput()->with('error', 'Tanggal selesai harus setelah tanggal mulai.');
        }

        // Cek Overlap
        $overlap = $this->pemesananModel->where('id_travel', $travel['id_travel'])
            ->whereIn('status_reservasi', ['Pending', 'Dikonfirmasi'])
            ->groupStart()
                ->where('tgl_mulai <=', $tgl_selesai)
                ->where('tgl_selesai >=', $tgl_mulai)
            ->groupEnd()
            ->first();

        if ($overlap) {
            return redirect()->back()->withInput()->with('error', 'Maaf, armada ini sudah direservasi pada rentang tanggal tersebut. Silakan pilih tanggal lain.');
        }

        $totalBayar = $durasi * $travel['harga_sewa'];

        $this->pemesananModel->save([
            'id_pelanggan'     => $pelanggan['id_pelanggan'],
            'id_travel'        => $travel['id_travel'],
            'tgl_mulai'        => $tgl_mulai,
            'tgl_selesai'      => $tgl_selesai,
            'total_bayar'      => $totalBayar,
            'status_reservasi' => 'Pending',
        ]);
        
        $idReservasi = $this->pemesananModel->getInsertID();

        // Integrasi API Mayar Payment Gateway
        $apiKey = env('MAYAR_API_KEY');
        $apiUrl = env('MAYAR_API_URL');

        if (!empty($apiKey)) {
            $userModel = new \App\Models\UserModel();
            $user = $userModel->find(session()->get('id_user'));

            $client = \Config\Services::curlrequest();
            
            $payload = [
                'name'        => $pelanggan['nama_pelanggan'],
                'email'       => $user['email'] ?? 'customer@ycr.com',
                'amount'      => (int)$totalBayar,
                'mobile'      => $pelanggan['no_telp'] ?? '08000000000',
                'redirectUrl' => base_url('pelanggan/riwayat'),
                'description' => "Reservasi " . $travel['nama_mobil'] . " (Trx ID: #" . $idReservasi . ")",
                'expiredAt'   => date('Y-m-d\TH:i:s.v\Z', strtotime('+1 day')), // Expired dalam 24 jam
            ];

            try {
                $response = $client->post($apiUrl . '/payment/create', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $apiKey,
                        'Content-Type'  => 'application/json',
                    ],
                    'json' => $payload,
                    'http_errors' => false
                ]);

                if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
                    $resBody = json_decode($response->getBody(), true);
                    if (isset($resBody['data']['link'])) {
                        // Simpan payment link ke database agar bisa dilanjutkan nanti
                        $this->pemesananModel->update($idReservasi, [
                            'payment_link' => $resBody['data']['link']
                        ]);
                        
                        // Redirect langsung ke halaman pembayaran Mayar
                        return redirect()->to($resBody['data']['link']);
                    }
                } else {
                    log_message('error', 'Mayar API Failed. Status: ' . $response->getStatusCode() . ' Body: ' . $response->getBody());
                }
            } catch (\Exception $e) {
                // Jika API gagal, biarkan proses berlanjut ke halaman riwayat secara normal
                log_message('error', 'Mayar API Error Exception: ' . $e->getMessage());
            }
        }

        return redirect()->to('/pelanggan/riwayat')->with('success', 'Reservasi berhasil dikirim. Silakan melakukan pembayaran atau tunggu konfirmasi admin.');
    }

    public function riwayat()
    {
        $pelanggan = $this->pelangganModel->where('id_user', session()->get('id_user'))->first();
        
        $data = [
            'title'   => 'Riwayat Reservasi',
            'riwayat' => $this->pemesananModel->select('pemesanan.*, travel.nama_mobil, travel.plat_nomor')
                                              ->join('travel', 'travel.id_travel = pemesanan.id_travel')
                                              ->where('id_pelanggan', $pelanggan['id_pelanggan'])
                                              ->orderBy('id_reservasi', 'DESC')
                                              ->findAll(),
        ];

        return view('pelanggan/riwayat', $data);
    }
}
