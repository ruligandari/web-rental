<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $travelModel = new \App\Models\TravelModel();
        
        $data = [
            'armada' => $travelModel->orderBy('id_travel', 'DESC')->limit(6)->findAll(),
        ];
        // Menutup sesi untuk menghindari file lock pada PHP built-in server
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
        }
        
        return view('landing', $data);
    }
}
