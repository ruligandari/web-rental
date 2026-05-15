<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        $role = session()->get('role');

        if ($role == 'owner') {
            return redirect()->to('/owner/dashboard');
        } elseif ($role == 'admin') {
            return redirect()->to('/admin/dashboard');
        } elseif ($role == 'pelanggan') {
            return redirect()->to('/pelanggan/dashboard');
        }

        return redirect()->to('/login');
    }
}
