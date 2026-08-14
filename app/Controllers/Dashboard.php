<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use App\Models\GajiModel;
use App\Models\DepartemenModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();
        
        // Jika yang login adalah karyawan, redirect ke dashboard karyawan
        if ($session->get('role') == 'karyawan') {
            return redirect()->to('/karyawan/dashboard');
        }

        $karyawanModel = new KaryawanModel();
        $gajiModel = new GajiModel();
        $departemenModel = new DepartemenModel();
        $userModel = new UserModel();

        $data = [
            'title' => 'Dashboard',
            'total_karyawan' => $karyawanModel->countAll(),
            'total_karyawan_aktif' => $karyawanModel->where('status_kerja', 'aktif')->countAllResults(),
            'total_departemen' => $departemenModel->countAll(),
            'total_user_karyawan' => $userModel->where('role', 'karyawan')->countAllResults(),
            'total_gaji_periode_ini' => $gajiModel->where('periode', date('Y-m'))->countAllResults(),
            'total_gaji_periode_sebelumnya' => $gajiModel->where('periode', date('Y-m', strtotime('-1 month')))->countAllResults(),
            'rekap_periode_ini' => $gajiModel->getRekapGajiPeriode(date('Y-m')),
            'rekap_periode_sebelumnya' => $gajiModel->getRekapGajiPeriode(date('Y-m', strtotime('-1 month'))),
            'departemen_list' => $departemenModel->getDepartemenWithCount(),
        ];

        return view('layouts/index', $data);
    }
}
