<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterBookingImagePathColumn extends Migration
{
    public function up()
    {
        //
        $fields = [
            'image_path' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ];
        $this->forge->addColumn('bookings', $fields);
    }

    public function down()
    {
        //
    }
}
