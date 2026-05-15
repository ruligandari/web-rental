<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PelangganModel;
use App\Models\PemesananModel;

class Crm extends BaseController
{
    protected $pelangganModel;
    protected $pemesananModel;

    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
        $this->pemesananModel = new PemesananModel();
    }

    public function index()
    {
        // Statistik Pelanggan (CRM)
        $data = [
            'title'     => 'CRM Operasional',
            'pelanggan' => $this->pelangganModel->select('pelanggan.*, COUNT(pemesanan.id_reservasi) as total_pesanan, SUM(pemesanan.total_bayar) as total_duit')
                                                ->join('pemesanan', 'pemesanan.id_pelanggan = pelanggan.id_pelanggan', 'left')
                                                ->groupBy('pelanggan.id_pelanggan')
                                                ->orderBy('total_duit', 'DESC')
                                                ->findAll(),
        ];

        return view('admin/crm/index', $data);
    }

    public function history($id_pelanggan)
    {
        $pelanggan = $this->pelangganModel->find($id_pelanggan);
        if (!$pelanggan) {
            return redirect()->to('/admin/crm')->with('error', 'Pelanggan tidak ditemukan.');
        }

        $data = [
            'title'     => 'Histori Pelanggan: ' . $pelanggan['nama_pelanggan'],
            'pelanggan' => $pelanggan,
            'riwayat'   => $this->pemesananModel->select('pemesanan.*, travel.nama_mobil')
                                              ->join('travel', 'travel.id_travel = pemesanan.id_travel')
                                              ->where('id_pelanggan', $id_pelanggan)
                                              ->orderBy('id_reservasi', 'DESC')
                                              ->findAll(),
        ];

        return view('admin/crm/history', $data);
    }
}
