<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        $session = session();
        if ($session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function processLogin()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['status'] == 'nonaktif') {
                return redirect()->back()->with('message', 'Akun Anda telah dinonaktifkan. Hubungi admin.');
            }

            $session->set([
                'isLoggedIn'  => true,
                'userId'      => $user['id'],
                'id_karyawan' => $user['id_karyawan'] ?? null,
                'username'    => $user['username'],
                'email'       => $user['email'],
                'nama_lengkap' => $user['nama_lengkap'],
                'role'        => $user['role'],
            ]);

            // Redirect berdasarkan role
            if ($user['role'] == 'admin') {
                return redirect()->to('/dashboard');
            } else {
                return redirect()->to('/karyawan/dashboard');
            }
        } else {
            return redirect()->back()->with('message', 'Username atau password salah.');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

    public function gantiPassword()
    {
        $session = session();
        $data = ['title' => 'Ganti Password'];
        return view('karyawan/ganti_password', $data);
    }

    public function prosesGantiPassword()
    {
        $session = session();
        $userModel = new UserModel();
        $userId = $session->get('userId');

        $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');
        $konfirmasiPassword = $this->request->getPost('konfirmasi_password');

        $user = $userModel->find($userId);

        if (! password_verify($passwordLama, $user['password'])) {
            return redirect()->back()->with('message', 'Password lama salah.');
        }

        if ($passwordBaru !== $konfirmasiPassword) {
            return redirect()->back()->with('message', 'Password baru dan konfirmasi tidak cocok.');
        }

        if (strlen($passwordBaru) < 6) {
            return redirect()->back()->with('message', 'Password minimal 6 karakter.');
        }

        $userModel->update($userId, [
            'password' => password_hash($passwordBaru, PASSWORD_DEFAULT)
        ]);

        return redirect()->back()->with('message', 'Password berhasil diganti.');
    }
}
