<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PemesananModel;
use App\Models\PelangganModel;

class Invoice extends BaseController
{
    public function index($id_reservasi)
    {
        $pemesananModel = new PemesananModel();
        
        $invoice = $pemesananModel->select('pemesanan.*, pelanggan.nama_pelanggan, pelanggan.no_telp, pelanggan.alamat, travel.nama_mobil, travel.plat_nomor, travel.harga_sewa')
                                  ->join('pelanggan', 'pelanggan.id_pelanggan = pemesanan.id_pelanggan')
                                  ->join('travel', 'travel.id_travel = pemesanan.id_travel')
                                  ->find($id_reservasi);

        if (!$invoice) {
            return redirect()->back()->with('error', 'Invoice tidak ditemukan.');
        }

        // Keamanan: Pelanggan hanya bisa melihat invoice sendiri
        if (session()->get('role') == 'pelanggan') {
            $pelangganModel = new PelangganModel();
            $p = $pelangganModel->where('id_user', session()->get('id_user'))->first();
            if ($invoice['id_pelanggan'] != $p['id_pelanggan']) {
                return redirect()->to('/pelanggan/dashboard')->with('error', 'Akses ditolak.');
            }
        }

        $data = [
            'title'   => 'Invoice #' . $invoice['id_reservasi'],
            'invoice' => $invoice
        ];

        return view('invoice/view', $data);
    }
}
