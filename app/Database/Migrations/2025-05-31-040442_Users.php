<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'level' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'password' => [
                'type' => 'TEXT',
                'constraint' => 0,
            ],
            'valid' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'ip' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'date_login' => [
                'type' => 'DATETIME',
                'constraint' => 0,
            ],
            'date_logout' => [
                'type' => 'DATETIME',
                'constraint' => 0,
            ],
            'session_id' => [
                'type' => 'TEXT',
                'constraint' => 0,
            ],
            'browser' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
