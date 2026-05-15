<?php

namespace App\Controllers\Owner;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PemesananModel;

class Laporan extends BaseController
{
    protected $pemesananModel;

    public function __construct()
    {
        $this->pemesananModel = new PemesananModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Laporan Transaksi',
            'laporan' => $this->pemesananModel->select('pemesanan.*, pelanggan.nama_pelanggan, travel.nama_mobil')
                                              ->join('pelanggan', 'pelanggan.id_pelanggan = pemesanan.id_pelanggan')
                                              ->join('travel', 'travel.id_travel = pemesanan.id_travel')
                                              ->findAll(),
            'tgl_awal'  => '',
            'tgl_akhir' => '',
        ];

        return view('owner/laporan/index', $data);
    }

    public function filter()
    {
        $tglAwal  = $this->request->getPost('tgl_awal');
        $tglAkhir = $this->request->getPost('tgl_akhir');

        $query = $this->pemesananModel->select('pemesanan.*, pelanggan.nama_pelanggan, travel.nama_mobil')
                                      ->join('pelanggan', 'pelanggan.id_pelanggan = pemesanan.id_pelanggan')
                                      ->join('travel', 'travel.id_travel = pemesanan.id_travel');

        if ($tglAwal && $tglAkhir) {
            $query->where('pemesanan.tgl_mulai >=', $tglAwal)
                  ->where('pemesanan.tgl_mulai <=', $tglAkhir);
        }

        $data = [
            'title'   => 'Laporan Transaksi',
            'laporan' => $query->findAll(),
            'tgl_awal'  => $tglAwal,
            'tgl_akhir' => $tglAkhir,
        ];

        return view('owner/laporan/index', $data);
    }
}
