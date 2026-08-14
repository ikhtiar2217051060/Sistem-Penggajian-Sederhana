<?php

namespace App\Models;

use CodeIgniter\Model;

class GajiModel extends Model
{
    protected $table            = 'gaji';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id_karyawan', 'periode', 'tanggal_gaji', 'gaji_pokok',
        'tunjangan_jabatan', 'tunjangan_makan', 'tunjangan_transport',
        'tunjangan_lain', 'potongan_absen', 'potongan_keterlambatan',
        'potongan_lain', 'potongan_pph', 'total_gaji', 'metode_pembayaran',
        'status', 'keterangan'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    public function getGajiFull()
    {
        return $this->select('gaji.*, karyawan.nip, karyawan.nama_lengkap, departemen.nama_departemen, jabatan.nama_jabatan')
            ->join('karyawan', 'karyawan.id = gaji.id_karyawan', 'left')
            ->join('departemen', 'departemen.id = karyawan.id_departemen', 'left')
            ->join('jabatan', 'jabatan.id = karyawan.id_jabatan', 'left')
            ->orderBy('gaji.periode', 'DESC')
            ->orderBy('gaji.id', 'DESC')
            ->findAll();
    }

    public function getGajiById($id)
    {
        return $this->select('gaji.*, karyawan.nip, karyawan.nama_lengkap, karyawan.no_telepon, karyawan.email,
            karyawan.no_rekening, karyawan.nama_bank, karyawan.status_pernikahan, karyawan.jumlah_tanggungan,
            departemen.nama_departemen, jabatan.nama_jabatan')
            ->join('karyawan', 'karyawan.id = gaji.id_karyawan', 'left')
            ->join('departemen', 'departemen.id = karyawan.id_departemen', 'left')
            ->join('jabatan', 'jabatan.id = karyawan.id_jabatan', 'left')
            ->where('gaji.id', $id)
            ->first();
    }

    public function getGajiByPeriode($periode)
    {
        return $this->select('gaji.*, karyawan.nip, karyawan.nama_lengkap, departemen.nama_departemen, jabatan.nama_jabatan')
            ->join('karyawan', 'karyawan.id = gaji.id_karyawan', 'left')
            ->join('departemen', 'departemen.id = karyawan.id_departemen', 'left')
            ->join('jabatan', 'jabatan.id = karyawan.id_jabatan', 'left')
            ->where('gaji.periode', $periode)
            ->findAll();
    }

    public function getGajiByKaryawanPeriode($id_karyawan, $periode)
    {
        return $this->where('id_karyawan', $id_karyawan)
            ->where('periode', $periode)
            ->first();
    }

    public function getRekapGajiPeriode($periode)
    {
        return $this->select('
            SUM(gaji_pokok) as total_gaji_pokok,
            SUM(tunjangan_jabatan) as total_tunjangan_jabatan,
            SUM(tunjangan_makan) as total_tunjangan_makan,
            SUM(tunjangan_transport) as total_tunjangan_transport,
            SUM(tunjangan_lain) as total_tunjangan_lain,
            SUM(potongan_absen) as total_potongan_absen,
            SUM(potongan_keterlambatan) as total_potongan_keterlambatan,
            SUM(potongan_lain) as total_potongan_lain,
            SUM(potongan_pph) as total_potongan_pph,
            SUM(total_gaji) as total_gaji
        ')
            ->where('periode', $periode)
            ->first();
    }
}
