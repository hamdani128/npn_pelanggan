<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProfileMitraDataLayanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kode_mitra' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'jenis_layanan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'kapasitas' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'quantity' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'vendor' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'deskripsi_otc' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'harga_pokok_otc' => [
                'type' => 'INT',
                'null' => true,
            ],
            'harga_jual_otc' => [
                'type' => 'INT',
                'null' => true,
            ],
            'harga_pokok_month' => [
                'type' => 'INT',
                'null' => true,
            ],
            'harga_jual_month' => [
                'type' => 'INT',
                'null' => true,
            ],
            'deskripsi_price' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'period_start_price' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'period_end_price' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('profile_mitra_data_layanan');
    }

    public function down()
    {
        $this->forge->dropTable('profile_mitra_data_layanan');
    }
}
