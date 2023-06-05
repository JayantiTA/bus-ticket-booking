<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'admin',
            'email'    => 'tes123@gmail.com',
            'password' => password_hash('tes123', PASSWORD_DEFAULT),
            'role_id' => 'admin'
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (name, email, password, role_id) VALUES(:name:, :email:, :password:, :role_id:)', $data);

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
