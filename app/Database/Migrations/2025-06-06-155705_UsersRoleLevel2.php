<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersRoleLevel2 extends Migration
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
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'modul_detail_level2' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'view' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'add' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'edit' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'delete' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users_role_level2');
    }

    public function down()
    {
        $this->forge->dropTable('users_role_level2');
    }
}