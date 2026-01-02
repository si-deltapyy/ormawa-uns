<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Superadmin',
            'email' => 'admin@role',
            'password' => bcrypt('123')
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@role',
            'password' => bcrypt('123')
        ]);

        $user->assignRole('user');

    }
}
