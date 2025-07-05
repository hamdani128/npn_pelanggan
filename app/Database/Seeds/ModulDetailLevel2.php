<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ModulDetailLevel2 extends Seeder
{
    public function run()
    {
        $data = [
            [
                'modul_detail_id' => '2',
                'name' => 'Legalitas Perusahaan',
                'url' => 'profile_pelanggan/kemitraan_reseller/legalitas',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 'System',
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 'System',
            ],
            [
                'modul_detail_id' => '2',
                'name' => 'Data Pelanggan',
                'url' => 'profile_pelanggan/kemitraan_reseller/customer_data',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 'System',
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 'System',
            ],
        ];
        // Insert data ke tabel users
        $this->db->table('modul_detail_level2')->insertBatch($data);
    }
}
