<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GajiModel;
use App\Models\KaryawanModel;

class KaryawanGaji extends BaseController
{
    public function index()
    {
        $session = session();
        $idKaryawan = $session->get('id_karyawan');

        $gajiModel = new GajiModel();
        $karyawanModel = new KaryawanModel();

        $karyawan = $karyawanModel->find($idKaryawan);

        // Semua gaji karyawan ini
        $gajiList = $gajiModel->where('id_karyawan', $idKaryawan)
            ->orderBy('periode', 'DESC')
            ->findAll();

        // Total gaji sepanjang masa
        $totalGajiAll = 0;
        foreach ($gajiList as $g) {
            $totalGajiAll += $g['total_gaji'];
        }

        $data = [
            'title' => 'Slip Gaji Saya',
            'karyawan' => $karyawan,
            'gaji' => $gajiList,
            'total_gaji_all' => $totalGajiAll,
            'total_periode_gaji' => count($gajiList),
        ];

        return view('karyawan/gaji_saya', $data);
    }

    public function slip($id)
    {
        $session = session();
        $idKaryawan = $session->get('id_karyawan');

        $gajiModel = new GajiModel();
        $gaji = $gajiModel->getGajiById($id);

        if (! $gaji || $gaji['id_karyawan'] != $idKaryawan) {
            return redirect()->to('/karyawan/gaji')->with('message', 'Slip gaji tidak ditemukan.');
        }

        $data = [
            'title' => 'Slip Gaji - ' . $gaji['nama_lengkap'],
            'gaji' => $gaji,
        ];

        return view('penggajian/slip_gaji', $data);
    }
}
