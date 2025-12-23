<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin1@gmail.com',
            'admin' => '1',
            'password' => bcrypt('123456'),
        ]);

        // User::create([
        //     'name' => 'User',
        //     'email' => 'normal@gmail.com',
        //     'admin' => '0',
        //     'password' => bcrypt('123456'),
        // ]);
    }
}