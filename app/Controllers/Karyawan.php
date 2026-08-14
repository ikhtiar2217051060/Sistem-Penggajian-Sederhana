<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use App\Models\DepartemenModel;
use App\Models\JabatanModel;
use App\Models\UserModel;

class Karyawan extends BaseController
{
    public function index()
    {
        $karyawanModel = new KaryawanModel();
        $userModel = new UserModel();
        $karyawanList = $karyawanModel->getKaryawanFull();
        
        // Cek apakah setiap karyawan sudah punya akun
        foreach ($karyawanList as &$k) {
            $existing = $userModel->where('id_karyawan', $k['id'])->first();
            $k['has_account'] = !empty($existing);
        }

        $data = [
            'title' => 'Data Karyawan',
            'karyawan' => $karyawanList,
        ];
        return view('karyawan/index', $data);
    }

    public function create()
    {
        $departemenModel = new DepartemenModel();
        $jabatanModel = new JabatanModel();
        $data = [
            'title' => 'Tambah Karyawan',
            'departemen' => $departemenModel->findAll(),
            'jabatan' => $jabatanModel->findAll(),
        ];
        return view('karyawan/form_karyawan', $data);
    }

    public function store()
    {
        $karyawanModel = new KaryawanModel();
        $data = [
            'nip' => $this->request->getPost('nip'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email' => $this->request->getPost('email'),
            'id_departemen' => $this->request->getPost('id_departemen'),
            'id_jabatan' => $this->request->getPost('id_jabatan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'status_kerja' => 'aktif',
            'npwp' => $this->request->getPost('npwp'),
            'no_rekening' => $this->request->getPost('no_rekening'),
            'nama_bank' => $this->request->getPost('nama_bank'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan'),
            'jumlah_tanggungan' => $this->request->getPost('jumlah_tanggungan') ?? 0,
        ];

        // Handle file upload
        $file = $this->request->getFile('foto');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/foto_karyawan', $newName);
            $data['foto'] = $newName;
        }

        $karyawanModel->insert($data);
        return redirect()->to('/karyawan')->with('message', 'Data karyawan berhasil ditambahkan.');
    }

    public function detail($id)
    {
        $karyawanModel = new KaryawanModel();
        $data = [
            'title' => 'Detail Karyawan',
            'karyawan' => $karyawanModel->getKaryawanById($id),
        ];
        return view('karyawan/detail_karyawan', $data);
    }

    public function edit($id)
    {
        $karyawanModel = new KaryawanModel();
        $departemenModel = new DepartemenModel();
        $jabatanModel = new JabatanModel();
        $data = [
            'title' => 'Edit Karyawan',
            'karyawan' => $karyawanModel->find($id),
            'departemen' => $departemenModel->findAll(),
            'jabatan' => $jabatanModel->findAll(),
        ];
        return view('karyawan/form_karyawan', $data);
    }

    public function update($id)
    {
        $karyawanModel = new KaryawanModel();
        $data = [
            'nip' => $this->request->getPost('nip'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email' => $this->request->getPost('email'),
            'id_departemen' => $this->request->getPost('id_departemen'),
            'id_jabatan' => $this->request->getPost('id_jabatan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'status_kerja' => $this->request->getPost('status_kerja'),
            'npwp' => $this->request->getPost('npwp'),
            'no_rekening' => $this->request->getPost('no_rekening'),
            'nama_bank' => $this->request->getPost('nama_bank'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan'),
            'jumlah_tanggungan' => $this->request->getPost('jumlah_tanggungan') ?? 0,
        ];

        $file = $this->request->getFile('foto');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/foto_karyawan', $newName);
            $data['foto'] = $newName;
        }

        $karyawanModel->update($id, $data);
        return redirect()->to('/karyawan')->with('message', 'Data karyawan berhasil diupdate.');
    }

    public function delete($id)
    {
        $karyawanModel = new KaryawanModel();
        $karyawanModel->delete($id);
        return redirect()->to('/karyawan')->with('message', 'Data karyawan berhasil dihapus.');
    }

    // Buat akun karyawan untuk login
    public function buatAkun($id)
    {
        $karyawanModel = new KaryawanModel();
        $userModel = new UserModel();
        $karyawan = $karyawanModel->find($id);

        if (! $karyawan) {
            return redirect()->to('/karyawan')->with('message', 'Karyawan tidak ditemukan.');
        }

        $existingUser = $userModel->where('id_karyawan', $id)->first();

        $data = [
            'title' => 'Buat Akun Karyawan',
            'karyawan' => $karyawan,
            'existing_user' => $existingUser,
        ];

        return view('karyawan/form_akun', $data);
    }

    public function simpanAkun()
    {
        $userModel = new UserModel();
        $karyawanModel = new KaryawanModel();

        $idKaryawan = $this->request->getPost('id_karyawan');
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $rules = [
            'username' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('message', $this->validator->listErrors());
        }

        $karyawan = $karyawanModel->find($idKaryawan);

        if (! $karyawan) {
            return redirect()->back()->withInput()->with('message', 'Karyawan tidak ditemukan.');
        }

        $existingUser = $userModel->where('id_karyawan', $idKaryawan)->first();

        if (! $userModel->isUsernameAvailable($username, $existingUser['id'] ?? null)) {
            return redirect()->back()->withInput()->with('message', 'Username sudah digunakan. Silakan pilih username lain.');
        }

        $userData = [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'nama_lengkap' => $karyawan['nama_lengkap'],
            'role' => $this->request->getPost('role') ?? 'karyawan',
            'status' => 'aktif',
        ];

        if ($existingUser) {
            $userModel->update($existingUser['id'], array_merge($userData, ['id_karyawan' => $idKaryawan]));
        } else {
            $userModel->insert(array_merge($userData, ['id_karyawan' => $idKaryawan]));
        }

        return redirect()->to('/karyawan')->with('message', 'Akun karyawan berhasil dibuat.');
    }
}
