<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PemesananModel;
use App\Models\TravelModel;

class Reservasi extends BaseController
{
    protected $pemesananModel;
    protected $travelModel;

    public function __construct()
    {
        $this->pemesananModel = new PemesananModel();
        $this->travelModel = new TravelModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Kelola Reservasi',
            'reservasi' => $this->pemesananModel->select('pemesanan.*, pelanggan.nama_pelanggan, travel.nama_mobil, travel.plat_nomor')
                                                ->join('pelanggan', 'pelanggan.id_pelanggan = pemesanan.id_pelanggan')
                                                ->join('travel', 'travel.id_travel = pemesanan.id_travel')
                                                ->orderBy('id_reservasi', 'DESC')
                                                ->paginate(15, 'reservasi'),
            'pager'     => $this->pemesananModel->pager,
        ];

        return view('admin/reservasi/index', $data);
    }

    public function konfirmasi($id)
    {
        $reservasi = $this->pemesananModel->find($id);
        if (!$reservasi) return redirect()->back()->with('error', 'Data tidak ditemukan.');

        // Update status reservasi
        $this->pemesananModel->update($id, ['status_reservasi' => 'Dikonfirmasi']);

        return redirect()->to('/admin/reservasi')->with('success', 'Reservasi berhasil dikonfirmasi.');
    }

    public function selesai($id)
    {
        $reservasi = $this->pemesananModel->find($id);
        if (!$reservasi) return redirect()->back()->with('error', 'Data tidak ditemukan.');

        // Update status reservasi
        $this->pemesananModel->update($id, ['status_reservasi' => 'Selesai']);

        return redirect()->to('/admin/reservasi')->with('success', 'Sewa armada telah selesai.');
    }
}
