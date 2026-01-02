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
        // User::create([
        //     'name' => 'Admin Ormawa UNS',
        //     'email' => 'or@gmail.com',
        //     'admin' => '1',
        //     'password' => bcrypt('123456'),
        // ])->assignRole('admin');

        // User::create([
        //     'name' => 'User',
        //     'email' => 'normal@gmail.com',
        //     'admin' => '0',
        //     'password' => bcrypt('123456'),
        // ]);
    }
}