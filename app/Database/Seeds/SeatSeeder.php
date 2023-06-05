<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeatSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'bus_id' => 1,
            'seat_position' => '1D',
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO seats (bus_id, seat_position) VALUES(:bus_id:, :seat_position:)', $data);

        // Using Query Builder
        $this->db->table('seats')->insert($data);
    }
}
