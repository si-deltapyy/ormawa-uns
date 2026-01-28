<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Mahasiswa;
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
            'name' => 'Admin Pusat',
            'email' => 'admin@role',
            'password' => bcrypt('123')
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Ketua Ormawa',
            'email' => 'jnukmi@ormawa.com',
            'password' => bcrypt('123')
        ]);

        Anggota::create([
            'user_id' => $user->id,
            'ormawa_id' => 1,
            'jabatan' => 'Ketua',
        ]);

        $user->givePermissionTo('ketua-ormawa');
        $user->assignRole('user');

        $user2 = User::create([
            'name' => 'Pembina Ormawa',
            'email' => 'pembina@ormawa.com',
            'password' => bcrypt('123')
        ]);

        Anggota::create([
            'user_id' => $user2->id,
            'ormawa_id' => 1,
            'jabatan' => 'Pembina',
        ]);
        $user2->givePermissionTo('pembina-ormawa');
        $user2->assignRole('user');

        Mahasiswa::create([
            'nim' => 'M0521065',
            'nama' => 'Budi Santoso',
        ]);

        Mahasiswa::create([
            'nim' => 'B0221001',
            'nama' => 'Andi Wijaya',
        ]);

    }
}
