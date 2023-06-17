<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Mahasiswa',
                'email' => 'mahasiswakece@gmail.com',
                'role' => 'mahasiswa',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'Admin',
                'email' => 'admincentil@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'Dosen',
                'email' => 'dosenpintar@gmail.com',
                'role' => 'dosen',
                'password' => bcrypt('12345')
            ],
        ];
        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
