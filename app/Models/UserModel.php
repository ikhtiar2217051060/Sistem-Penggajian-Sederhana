<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['id_karyawan', 'username', 'email', 'password', 'nama_lengkap', 'role', 'status'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    public function isUsernameAvailable($username, $ignoreId = null): bool
    {
        $builder = $this->where('username', $username);

        if ($ignoreId !== null) {
            $builder->where('id !=', $ignoreId);
        }

        return $builder->countAllResults() === 0;
    }
}
