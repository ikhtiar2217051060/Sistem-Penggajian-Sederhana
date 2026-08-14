<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JabatanModel;
use App\Models\DepartemenModel;

class Jabatan extends BaseController
{
    public function index()
    {
        $jabatanModel = new JabatanModel();
        $data = [
            'title' => 'Data Jabatan',
            'jabatan' => $jabatanModel->getJabatanWithDepartemen(),
        ];
        return view('karyawan/jabatan', $data);
    }

    public function create()
    {
        $departemenModel = new DepartemenModel();
        $data = [
            'title' => 'Tambah Jabatan',
            'departemen' => $departemenModel->findAll(),
        ];
        return view('karyawan/form_jabatan', $data);
    }

    public function store()
    {
        $jabatanModel = new JabatanModel();
        $jabatanModel->insert([
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
            'id_departemen' => $this->request->getPost('id_departemen'),
            'gaji_pokok' => $this->request->getPost('gaji_pokok'),
            'tunjangan_jabatan' => $this->request->getPost('tunjangan_jabatan'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);
        return redirect()->to('/jabatan')->with('message', 'Data jabatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jabatanModel = new JabatanModel();
        $departemenModel = new DepartemenModel();
        $data = [
            'title' => 'Edit Jabatan',
            'jabatan' => $jabatanModel->find($id),
            'departemen' => $departemenModel->findAll(),
        ];
        return view('karyawan/form_jabatan', $data);
    }

    public function update($id)
    {
        $jabatanModel = new JabatanModel();
        $jabatanModel->update($id, [
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
            'id_departemen' => $this->request->getPost('id_departemen'),
            'gaji_pokok' => $this->request->getPost('gaji_pokok'),
            'tunjangan_jabatan' => $this->request->getPost('tunjangan_jabatan'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);
        return redirect()->to('/jabatan')->with('message', 'Data jabatan berhasil diupdate.');
    }

    public function delete($id)
    {
        $jabatanModel = new JabatanModel();
        $jabatanModel->delete($id);
        return redirect()->to('/jabatan')->with('message', 'Data jabatan berhasil dihapus.');
    }
}
