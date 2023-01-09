<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rooms extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'room_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'room_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'floor' => [
                'type' => 'INT',
                'constraint' => 1
            ],
            'building' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'is_ready' => [
                'type' => 'INT',
                'constraint' => 1
            ]
        ]);
        $this->forge->addKey('room_id', true);
        $this->forge->createTable('rooms');
    }

    public function down()
    {
        //
    }
}
