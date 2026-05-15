<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PemesananModel;
use App\Models\TravelModel;

class Webhook extends ResourceController
{
    public function mayar()
    {
        // Get JSON payload
        $json = $this->request->getJSON(true);
        
        if (!$json) {
            return $this->fail('Invalid JSON Payload', 400);
        }

        // Cek event type
        $event = $json['event'] ?? '';
        
        if ($event === 'payment.received') {
            $data = $json['data'] ?? [];
            $status = $data['status'] ?? '';

            if ($status === 'SUCCESS') {
                // Kita mencari ID Reservasi dari field productName atau productDescription
                $productName = $data['productName'] ?? '';
                $productDesc = $data['productDescription'] ?? '';
                $searchString = $productName . ' ' . $productDesc;
                
                // Regex untuk menangkap "(Trx ID: #123)"
                if (preg_match('/Trx ID: #(\d+)/', $searchString, $matches)) {
                    $idReservasi = $matches[1];

                    $pemesananModel = new PemesananModel();
                    $travelModel = new TravelModel();

                    $reservasi = $pemesananModel->find($idReservasi);
                    
                    if ($reservasi && $reservasi['status_reservasi'] === 'Pending') {
                        $db = \Config\Database::connect();
                        $db->transStart();

                        $metodeBayar = $data['channel'] ?? $data['paymentMethod'] ?? 'Mayar Gateway';
                        
                        // Auto Konfirmasi
                        $pemesananModel->update($idReservasi, [
                            'status_reservasi' => 'Dikonfirmasi',
                            'tgl_bayar'        => date('Y-m-d'),
                            'metode_pembayaran'=> $metodeBayar
                        ]);

                        $db->transComplete();

                        if ($db->transStatus() !== false) {
                            log_message('info', 'Webhook Mayar: Reservasi #' . $idReservasi . ' otomatis dikonfirmasi.');
                            return $this->respond(['message' => 'Success'], 200);
                        }
                    }
                }
            }
        }

        // Return 200 OK agar Mayar tidak melakukan retry
        return $this->respond(['message' => 'Received'], 200);
    }
}
