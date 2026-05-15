<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\TravelModel;

class Travel extends BaseController
{
    protected $travelModel;

    public function __construct()
    {
        $this->travelModel = new TravelModel();
    }

    public function index()
    {
        $data = [
            'title'  => 'Kelola Travel',
            'travel' => $this->travelModel->paginate(10, 'travel'),
            'pager'  => $this->travelModel->pager,
        ];

        return view('admin/travel/index', $data);
    }

    public function create()
    {
        return view('admin/travel/create', ['title' => 'Tambah Travel']);
    }

    public function store()
    {
        $rules = [
            'nama_mobil'  => 'required',
            'plat_nomor'  => 'required',
            'harga_sewa'  => 'required|numeric',
            'foto'        => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $foto = $this->request->getFile('foto');
        $namaFoto = $foto->getRandomName();
        $foto->move('uploads/travel', $namaFoto);

        $this->travelModel->save([
            'nama_mobil'  => $this->request->getPost('nama_mobil'),
            'plat_nomor'  => $this->request->getPost('plat_nomor'),
            'harga_sewa'  => $this->request->getPost('harga_sewa'),
            'status_mobil'=> $this->request->getPost('status_mobil') ?? 'Tersedia',
            'foto'        => $namaFoto,
        ]);

        return redirect()->to('/admin/travel')->with('success', 'Data travel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $travel = $this->travelModel->find($id);
        if (!$travel) {
            return redirect()->to('/admin/travel')->with('error', 'Data tidak ditemukan.');
        }

        return view('admin/travel/edit', [
            'title'  => 'Edit Travel',
            'travel' => $travel
        ]);
    }

    public function update($id)
    {
        $travel = $this->travelModel->find($id);
        
        $rules = [
            'nama_mobil'  => 'required',
            'plat_nomor'  => 'required',
            'harga_sewa'  => 'required|numeric',
            'foto'        => 'max_size[foto,2048]|is_image[foto]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $foto = $this->request->getFile('foto');
        $namaFoto = $travel['foto'];

        if ($foto->isValid() && !$foto->hasMoved()) {
            // Hapus foto lama jika ada
            if (file_exists('uploads/travel/' . $travel['foto'])) {
                unlink('uploads/travel/' . $travel['foto']);
            }
            $namaFoto = $foto->getRandomName();
            $foto->move('uploads/travel', $namaFoto);
        }

        $this->travelModel->update($id, [
            'nama_mobil'  => $this->request->getPost('nama_mobil'),
            'plat_nomor'  => $this->request->getPost('plat_nomor'),
            'harga_sewa'  => $this->request->getPost('harga_sewa'),
            'status_mobil'=> $this->request->getPost('status_mobil'),
            'foto'        => $namaFoto,
        ]);

        return redirect()->to('/admin/travel')->with('success', 'Data travel berhasil diperbarui.');
    }

    public function delete($id)
    {
        $travel = $this->travelModel->find($id);
        if ($travel) {
            if (file_exists('uploads/travel/' . $travel['foto'])) {
                unlink('uploads/travel/' . $travel['foto']);
            }
            $this->travelModel->delete($id);
        }

        return redirect()->to('/admin/travel')->with('success', 'Data travel berhasil dihapus.');
    }
}
