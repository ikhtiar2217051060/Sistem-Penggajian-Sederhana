<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $table            = 'jabatan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_jabatan', 'id_departemen', 'gaji_pokok', 'tunjangan_jabatan', 'keterangan'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    public function getJabatanWithDepartemen()
    {
        return $this->select('jabatan.*, departemen.nama_departemen')
            ->join('departemen', 'departemen.id = jabatan.id_departemen', 'left')
            ->findAll();
    }

    public function getJabatanById($id)
    {
        return $this->select('jabatan.*, departemen.nama_departemen')
            ->join('departemen', 'departemen.id = jabatan.id_departemen', 'left')
            ->where('jabatan.id', $id)
            ->first();
    }
}
