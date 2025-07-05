<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProfileMitraDocument extends Migration
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
            'doc_type_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'file_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'file_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->createTable('profile_mitra_document');
    }

    public function down()
    {
        $this->forge->dropTable('profile_mitra_document');
    }
}
