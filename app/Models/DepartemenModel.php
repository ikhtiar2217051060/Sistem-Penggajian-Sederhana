<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartemenModel extends Model
{
    protected $table            = 'departemen';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_departemen', 'keterangan'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    public function getDepartemenWithCount()
    {
        return $this->select('departemen.*, COUNT(karyawan.id) as jumlah_karyawan')
            ->join('karyawan', 'karyawan.id_departemen = departemen.id', 'left')
            ->groupBy('departemen.id')
            ->findAll();
    }
}
