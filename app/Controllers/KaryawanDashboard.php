<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use App\Models\GajiModel;

class KaryawanDashboard extends BaseController
{
    public function index()
    {
        $session = session();
        $idKaryawan = $session->get('id_karyawan');

        if (! $idKaryawan) {
            return redirect()->to('/login')->with('message', 'Akun karyawan tidak terhubung.');
        }

        $karyawanModel = new KaryawanModel();
        $gajiModel = new GajiModel();

        $karyawan = $karyawanModel->getKaryawanById($idKaryawan);

        // Gaji terakhir
        $gajiTerakhir = $gajiModel->where('id_karyawan', $idKaryawan)
            ->orderBy('periode', 'DESC')
            ->first();

        // Total gaji sepanjang masa
        $totalGajiAll = $gajiModel->where('id_karyawan', $idKaryawan)
            ->selectSum('total_gaji', 'total')
            ->get()
            ->getRowArray()['total'] ?? 0;

        // Jumlah periode gaji
        $totalPeriodeGaji = $gajiModel->where('id_karyawan', $idKaryawan)->countAllResults();

        $data = [
            'title' => 'Dashboard Karyawan',
            'karyawan' => $karyawan,
            'gaji_terakhir' => $gajiTerakhir,
            'total_gaji_all' => $totalGajiAll,
            'total_periode_gaji' => $totalPeriodeGaji,
        ];

        return view('karyawan/dashboard', $data);
    }
}
