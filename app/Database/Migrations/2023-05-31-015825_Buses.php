<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Buses extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'source' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'destination' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'departure_time' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'arrival_time' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'seats' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'fare' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('buses');
    }

    public function down()
    {
        $this->forge->dropTable('buses');
    }
}
