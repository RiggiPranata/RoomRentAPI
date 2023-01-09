<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rents extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'room_id' => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'time_start' => [
                'type' => 'TIME'
            ],
            'time_end' => [
                'type' => 'TIME'
            ],
            'date' => [
                'type' => 'DATE'
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'no_telepon' => [
                'type' => 'VARCHAR',
                'constraint' => 16
            ],
            'remark' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'is_valid' => [
                'type' => 'INT',
                'constraint' => 1
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('rents');
    }

    public function down()
    {
        //
    }
}
