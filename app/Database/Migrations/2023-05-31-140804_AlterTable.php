<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTable extends Migration
{
    public function up()
    {
        $this->forge->addForeignKey('bus_id', 'buses', 'id', 'CASCADE', 'CASCADE', 'seats_ibfk_1');
        $this->forge->processIndexes('seats');
        $this->forge->addForeignKey('bus_id', 'buses', 'id', 'CASCADE', 'CASCADE', 'bookings_ibfk_1');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE', 'bookings_ibfk_2');
        $this->forge->addForeignKey('seat_id', 'seats', 'id', 'CASCADE', 'CASCADE', 'bookings_ibfk_3');
        $this->forge->processIndexes('bookings');
        // $this->forge->dropForeignKey('bookings', 'user_id_fk');
    }

    public function down()
    {
        // $this->forge->dropForeignKey('bookings', 'user_id_fk');
    }
}
