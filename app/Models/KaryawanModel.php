<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table            = 'karyawan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nip', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
        'agama', 'alamat', 'no_telepon', 'email', 'id_departemen', 'id_jabatan',
        'tanggal_masuk', 'status_kerja', 'npwp', 'no_rekening', 'nama_bank',
        'status_pernikahan', 'jumlah_tanggungan', 'foto'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    public function getKaryawanFull()
    {
        return $this->select('karyawan.*, departemen.nama_departemen, jabatan.nama_jabatan')
            ->join('departemen', 'departemen.id = karyawan.id_departemen', 'left')
            ->join('jabatan', 'jabatan.id = karyawan.id_jabatan', 'left')
            ->findAll();
    }

    public function getKaryawanById($id)
    {
        return $this->select('karyawan.*, departemen.nama_departemen, jabatan.nama_jabatan, jabatan.gaji_pokok, jabatan.tunjangan_jabatan')
            ->join('departemen', 'departemen.id = karyawan.id_departemen', 'left')
            ->join('jabatan', 'jabatan.id = karyawan.id_jabatan', 'left')
            ->where('karyawan.id', $id)
            ->first();
    }

    public function getKaryawanDropdown()
    {
        return $this->select('id, nip, nama_lengkap')
            ->where('status_kerja', 'aktif')
            ->orderBy('nama_lengkap', 'ASC')
            ->findAll();
    }

    public function getKaryawanAktif()
    {
        return $this->where('status_kerja', 'aktif')->findAll();
    }
}
