<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Modul extends Seeder
{
    public function run()
    {
        $data = [
            [
                'modul' => 'Master Data',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 'System',
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 'System',
            ],
            [
                'modul' => 'Profile Pelanggan',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 'System',
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 'System',
            ],
        ];
        // Insert data ke tabel users
        $this->db->table('modul')->insertBatch($data);
    }
}
