<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ModulDetail extends Seeder
{
    public function run()
    {
        $data = [
            [
                'modul_id' => '1',
                'name' => 'Supported Document',
                'url' => 'master/supported_document',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 'System',
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 'System',
            ],
            [
                'modul_id' => '2',
                'name' => 'Kemitraan / Reseller',
                'url' => 'profile_pelanggan/kemitraan_reseller',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 'System',
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 'System',
            ],
        ];
        // Insert data ke tabel users
        $this->db->table('modul_detail')->insertBatch($data);
    }
}