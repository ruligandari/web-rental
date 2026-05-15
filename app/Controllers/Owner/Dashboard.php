<?php

namespace App\Controllers\Owner;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PemesananModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $pemesananModel = new PemesananModel();
        
        // Menghitung pendapatan per bulan untuk tahun ini
        $tahunIni = date('Y');
        $monthlyIncome = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        
        // Ambil data pemesanan tahun ini yang sudah Selesai atau Dikonfirmasi
        $pesananTahunIni = $pemesananModel->where('YEAR(tgl_mulai)', $tahunIni)
                                          ->whereIn('status_reservasi', ['Dikonfirmasi', 'Selesai'])
                                          ->findAll();
                                          
        foreach ($pesananTahunIni as $row) {
            $bulan = (int)date('n', strtotime($row['tgl_mulai'])) - 1; // 0-11
            $monthlyIncome[$bulan] += $row['total_bayar'];
        }

        // Aktifitas terbaru (5 pesanan terakhir)
        $aktifitas_terbaru = $pemesananModel->select('pemesanan.*, pelanggan.nama_pelanggan, travel.nama_mobil')
                                            ->join('pelanggan', 'pelanggan.id_pelanggan = pemesanan.id_pelanggan')
                                            ->join('travel', 'travel.id_travel = pemesanan.id_travel')
                                            ->orderBy('id_reservasi', 'DESC')
                                            ->limit(5)
                                            ->findAll();

        $data = [
            'title'           => 'Dashboard Owner',
            'total_penjualan' => $pemesananModel->countAllResults(),
            'total_pendapatan'=> $pemesananModel->selectSum('total_bayar')->first()['total_bayar'] ?? 0,
            'chart_data'      => [
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                'values' => $monthlyIncome
            ],
            'aktifitas_terbaru' => $aktifitas_terbaru
        ];

        return view('owner/dashboard', $data);
    }
}
