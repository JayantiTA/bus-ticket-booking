<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'Jayakarta',
            'source' => 'Jakarta',
            'destination' => 'Surabaya',
            'departure_time' => '10:00:00',
            'arrival_time' => '00:00:00',
            'seats' => 30,
            'fare' => 500000,
            'day' => 1
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO buses (name, source, destination, departure_time, arrival_time, seats, fare) VALUES(:name:, :source:, :destination:, :departure_time:, :arrival_time:, :seats:, :fare:)', $data);

        // Using Query Builder
        $this->db->table('buses')->insert($data);
    }
}
