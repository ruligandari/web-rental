<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\TravelModel;
use App\Models\PelangganModel;
use App\Models\PemesananModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $travelModel = new TravelModel();
        $pelangganModel = new PelangganModel();
        $pemesananModel = new PemesananModel();

        $data = [
            'title'           => 'Dashboard Admin',
            'total_travel'    => $travelModel->countAllResults(),
            'total_pelanggan' => $pelangganModel->countAllResults(),
            'pending_orders'  => $pemesananModel->where('status_reservasi', 'Pending')->countAllResults(),
            'recent_orders'   => $pemesananModel->select('pemesanan.*, pelanggan.nama_pelanggan')
                                                ->join('pelanggan', 'pelanggan.id_pelanggan = pemesanan.id_pelanggan')
                                                ->orderBy('id_reservasi', 'DESC')->limit(5)->get()->getResultArray(),
        ];

        return view('admin/dashboard', $data);
    }
}
