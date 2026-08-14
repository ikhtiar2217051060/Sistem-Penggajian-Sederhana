<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GajiModel;
use App\Models\KaryawanModel;


class Penggajian extends BaseController
{
    public function index()
    {
        $gajiModel = new GajiModel();
        $data = [
            'title' => 'Data Penggajian',
            'gaji' => $gajiModel->getGajiFull(),
        ];
        return view('penggajian/index', $data);
    }

    public function create()
    {
        $karyawanModel = new KaryawanModel();
        $data = [
            'title' => 'Buat Penggajian',
            'karyawan' => $karyawanModel->getKaryawanDropdown(),
            'periode' => date('Y-m'),
        ];
        return view('penggajian/form_penggajian', $data);
    }

    public function store()
    {
        $gajiModel = new GajiModel();
        $karyawanModel = new KaryawanModel();

        $id_karyawan = $this->request->getPost('id_karyawan');
        $periode = $this->request->getPost('periode');

        // Cek apakah sudah ada gaji untuk karyawan di periode tersebut
        $existing = $gajiModel->getGajiByKaryawanPeriode($id_karyawan, $periode);
        if ($existing) {
            return redirect()->back()->with('message', 'Gaji untuk karyawan pada periode tersebut sudah ada.');
        }

        // Ambil data karyawan dan jabatan
        $karyawan = $karyawanModel->getKaryawanById($id_karyawan);

        // Hitung gaji
        $gaji_pokok = $karyawan['gaji_pokok'] ?? 0;
        $tunjangan_jabatan = $karyawan['tunjangan_jabatan'] ?? 0;
        $tunjangan_makan = $this->request->getPost('tunjangan_makan') ?? 500000;
        $tunjangan_transport = $this->request->getPost('tunjangan_transport') ?? 500000;
        $tunjangan_lain = $this->request->getPost('tunjangan_lain') ?? 0;

        // Hitung potongan
        $potongan_absen = 0;
        $potongan_keterlambatan = 0;
        $potongan_lain = $this->request->getPost('potongan_lain') ?? 0;

        // Hitung PPH (sederhana: 5% dari penghasilan bruto)
        $penghasilan_bruto = $gaji_pokok + $tunjangan_jabatan + $tunjangan_makan + $tunjangan_transport + $tunjangan_lain;
        $potongan_pph = round($penghasilan_bruto * 0.05, 2);

        $total_gaji = $penghasilan_bruto - $potongan_absen - $potongan_keterlambatan - $potongan_lain - $potongan_pph;

        $gajiModel->insert([
            'id_karyawan' => $id_karyawan,
            'periode' => $periode,
            'tanggal_gaji' => $this->request->getPost('tanggal_gaji'),
            'gaji_pokok' => $gaji_pokok,
            'tunjangan_jabatan' => $tunjangan_jabatan,
            'tunjangan_makan' => $tunjangan_makan,
            'tunjangan_transport' => $tunjangan_transport,
            'tunjangan_lain' => $tunjangan_lain,
            'potongan_absen' => $potongan_absen,
            'potongan_keterlambatan' => $potongan_keterlambatan,
            'potongan_lain' => $potongan_lain,
            'potongan_pph' => $potongan_pph,
            'total_gaji' => $total_gaji,
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/penggajian')->with('message', 'Data penggajian berhasil ditambahkan.');
    }

    public function detail($id)
    {
        $gajiModel = new GajiModel();
        $data = [
            'title' => 'Detail Penggajian',
            'gaji' => $gajiModel->getGajiById($id),
        ];
        return view('penggajian/detail_penggajian', $data);
    }

    public function edit($id)
    {
        $gajiModel = new GajiModel();
        $karyawanModel = new KaryawanModel();

        $gaji = $gajiModel->getGajiById($id);
        if (! $gaji) {
            return redirect()->to('/penggajian')->with('message', 'Data penggajian tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Penggajian',
            'gaji' => $gaji,
            'karyawan' => $karyawanModel->getKaryawanDropdown(),
        ];
        return view('penggajian/form_penggajian_edit', $data);
    }

    public function update($id)
    {
        $gajiModel = new GajiModel();
        $gajiModel->update($id, [
            'tanggal_gaji' => $this->request->getPost('tanggal_gaji'),
            'gaji_pokok' => $this->request->getPost('gaji_pokok'),
            'tunjangan_jabatan' => $this->request->getPost('tunjangan_jabatan'),
            'tunjangan_makan' => $this->request->getPost('tunjangan_makan'),
            'tunjangan_transport' => $this->request->getPost('tunjangan_transport'),
            'tunjangan_lain' => $this->request->getPost('tunjangan_lain'),
            'potongan_absen' => $this->request->getPost('potongan_absen'),
            'potongan_keterlambatan' => $this->request->getPost('potongan_keterlambatan'),
            'potongan_lain' => $this->request->getPost('potongan_lain'),
            'potongan_pph' => $this->request->getPost('potongan_pph'),
            'total_gaji' => $this->request->getPost('total_gaji'),
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);
        return redirect()->to('/penggajian')->with('message', 'Data penggajian berhasil diupdate.');
    }

    public function delete($id)
    {
        $gajiModel = new GajiModel();
        $gajiModel->delete($id);
        return redirect()->to('/penggajian')->with('message', 'Data penggajian berhasil dihapus.');
    }

    public function slip($id)
    {
        $gajiModel = new GajiModel();
        $session = session();

        $gaji = $gajiModel->getGajiById($id);

        if (! $gaji) {
            return redirect()->to('/dashboard')->with('message', 'Data tidak ditemukan.');
        }

        // Jika user karyawan, hanya boleh lihat slip gaji sendiri
        if ($session->get('role') == 'karyawan') {
            if ($gaji['id_karyawan'] != $session->get('id_karyawan')) {
                return redirect()->to('/karyawan/gaji')->with('message', 'Anda tidak memiliki akses ke slip gaji tersebut.');
            }
        }

        $data = [
            'title' => 'Slip Gaji - ' . $gaji['nama_lengkap'],
            'gaji' => $gaji,
        ];
        return view('penggajian/slip_gaji', $data);
    }
}
