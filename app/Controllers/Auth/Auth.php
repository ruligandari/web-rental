<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;
use App\Models\PelangganModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $sessionData = [
                'id_user'   => $user['id_user'],
                'username'  => $user['username'],
                'role'      => $user['role'],
                'logged_in' => true,
            ];
            session()->set($sessionData);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Username atau Password salah.');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function attemptRegister()
    {
        $rules = [
            'nama_lengkap' => 'required|min_length[3]',
            'email'        => 'required|valid_email|is_unique[user.email]',
            'username'     => 'required|is_unique[user.username]',
            'password'     => 'required|min_length[6]',
            'no_telp'      => 'required',
            'alamat'       => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $pelangganModel = new PelangganModel();

        $db = \Config\Database::connect();
        $db->transStart();

        $userModel->save([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'pelanggan',
        ]);

        $userId = $userModel->getInsertID();

        $pelangganModel->save([
            'id_user'        => $userId,
            'nama_pelanggan' => $this->request->getPost('nama_lengkap'),
            'no_telp'        => $this->request->getPost('no_telp'),
            'alamat'         => $this->request->getPost('alamat'),
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal melakukan registrasi.');
        }

        return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
