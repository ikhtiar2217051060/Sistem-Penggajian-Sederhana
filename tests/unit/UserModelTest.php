<?php

use App\Models\UserModel;
use CodeIgniter\Test\CIUnitTestCase;

/**
 * @internal
 */
final class UserModelTest extends CIUnitTestCase
{
    public function testUsernameAvailabilityExcludesTheCurrentUser(): void
    {
        $db = \Config\Database::connect('tests');
        $forge = \Config\Database::forge('tests');

        if ($db->tableExists('users')) {
            $forge->dropTable('users', true);
        }

        $forge->addField([
            'id' => ['type' => 'INTEGER', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'id_karyawan' => ['type' => 'INTEGER', 'constraint' => 5, 'unsigned' => true, 'null' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 100],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'nama_lengkap' => ['type' => 'VARCHAR', 'constraint' => 255],
            'role' => ['type' => 'VARCHAR', 'constraint' => 50],
            'status' => ['type' => 'VARCHAR', 'constraint' => 50],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $forge->addPrimaryKey('id');
        $forge->addUniqueKey('username');
        $forge->createTable('users', true);

        $model = new UserModel();
        $model->db->setDatabase('tests');

        $id = $model->insert([
            'username' => 'existing-user',
            'email' => 'existing@example.com',
            'password' => 'secret',
            'nama_lengkap' => 'Existing User',
            'role' => 'karyawan',
            'status' => 'aktif',
        ]);

        $this->assertFalse($model->isUsernameAvailable('existing-user'));
        $this->assertTrue($model->isUsernameAvailable('another-user'));
        $this->assertTrue($model->isUsernameAvailable('existing-user', $id));
    }
}
