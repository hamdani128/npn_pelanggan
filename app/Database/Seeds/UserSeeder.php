<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'Super Admin',
                'name' => 'Super Admin',
                'email' => 'rd_super_admin@npn.net.id',
                'password' => md5('admin123'),
                'level' => 'super admin',
                'valid' => 0,
            ],
        ];
        // Insert data ke tabel users
        $this->db->table('users')->insertBatch($data);

    }
}
