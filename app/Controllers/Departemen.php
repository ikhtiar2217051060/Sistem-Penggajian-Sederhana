<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartemenModel;

class Departemen extends BaseController
{
    public function index()
    {
        $departemenModel = new DepartemenModel();
        $data = [
            'title' => 'Data Departemen',
            'departemen' => $departemenModel->getDepartemenWithCount(),
        ];
        // dd($data);
        return view('karyawan/departemen', $data);
    }

    public function create()
    {
        $data = ['title' => 'Tambah Departemen'];
        return view('karyawan/form_departemen', $data);
    }

    public function store()
    {
        $departemenModel = new DepartemenModel();
        $departemenModel->insert([
            'nama_departemen' => $this->request->getPost('nama_departemen'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);
        return redirect()->to('/departemen')->with('message', 'Data departemen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $departemenModel = new DepartemenModel();
        $data = [
            'title' => 'Edit Departemen',
            'departemen' => $departemenModel->find($id),
        ];
        return view('karyawan/form_departemen', $data);
    }

    public function update($id)
    {
        $departemenModel = new DepartemenModel();
        $departemenModel->update($id, [
            'nama_departemen' => $this->request->getPost('nama_departemen'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);
        return redirect()->to('/departemen')->with('message', 'Data departemen berhasil diupdate.');
    }

    public function delete($id)
    {
        $departemenModel = new DepartemenModel();
        $departemenModel->delete($id);
        return redirect()->to('/departemen')->with('message', 'Data departemen berhasil dihapus.');
    }
}
