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
                'constraint' => 5,
                'auto_increment' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'no_telepon' => [
                'type' => 'VARCHAR',
                'constraint' => 16
            ],
            'kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 15
            ],
            'semester' => [
                'type' => 'INT',
                'constraint' => 2
            ],
            'jurusan' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        //
    }
}
