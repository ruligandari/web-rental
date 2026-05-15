<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PelangganModel;
use App\Models\UserModel;

class Pelanggan extends BaseController
{
    protected $pelangganModel;
    protected $userModel;

    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Kelola Pelanggan',
            'pelanggan' => $this->pelangganModel->select('pelanggan.*, user.username, user.email')
                                                ->join('user', 'user.id_user = pelanggan.id_user')
                                                ->paginate(10, 'pelanggan'),
            'pager'     => $this->pelangganModel->pager,
        ];

        return view('admin/pelanggan/index', $data);
    }

    public function create()
    {
        return view('admin/pelanggan/create', ['title' => 'Tambah Pelanggan']);
    }

    public function store()
    {
        $rules = [
            'nama_pelanggan' => 'required|min_length[3]',
            'email'          => 'required|valid_email|is_unique[user.email]',
            'username'       => 'required|is_unique[user.username]',
            'password'       => 'required|min_length[6]',
            'no_telp'        => 'required',
            'alamat'         => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $this->userModel->save([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'pelanggan',
        ]);

        $userId = $this->userModel->getInsertID();

        $this->pelangganModel->save([
            'id_user'        => $userId,
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'no_telp'        => $this->request->getPost('no_telp'),
            'alamat'         => $this->request->getPost('alamat'),
        ]);

        $db->transComplete();

        return redirect()->to('/admin/pelanggan')->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pelanggan = $this->pelangganModel->select('pelanggan.*, user.username, user.email')
                                          ->join('user', 'user.id_user = pelanggan.id_user')
                                          ->find($id);
        
        if (!$pelanggan) {
            return redirect()->to('/admin/pelanggan')->with('error', 'Data tidak ditemukan.');
        }

        return view('admin/pelanggan/edit', [
            'title'     => 'Edit Pelanggan',
            'pelanggan' => $pelanggan
        ]);
    }

    public function update($id)
    {
        $pelanggan = $this->pelangganModel->find($id);
        
        $rules = [
            'nama_pelanggan' => 'required|min_length[3]',
            'email'          => "required|valid_email|is_unique[user.email,id_user,{$pelanggan['id_user']}]",
            'username'       => "required|is_unique[user.username,id_user,{$pelanggan['id_user']}]",
            'no_telp'        => 'required',
            'alamat'         => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $userData = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
        ];

        if ($this->request->getPost('password')) {
            $userData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($pelanggan['id_user'], $userData);

        $this->pelangganModel->update($id, [
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'no_telp'        => $this->request->getPost('no_telp'),
            'alamat'         => $this->request->getPost('alamat'),
        ]);

        $db->transComplete();

        return redirect()->to('/admin/pelanggan')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $pelanggan = $this->pelangganModel->find($id);
        if ($pelanggan) {
            // Menghapus user akan menghapus pelanggan karena CASCADE di database
            $this->userModel->delete($pelanggan['id_user']);
        }

        return redirect()->to('/admin/pelanggan')->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
