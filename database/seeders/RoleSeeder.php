<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::create([
            'name' => 'super-admin',
            'guard_name' => 'web'
        ]);
        
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'user',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'stakeholder',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'ormawa',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'pembina',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'ketua-ormawa',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'anggota-ormawa',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'pembina-ormawa',
            'guard_name' => 'web'
        ]);



    }
}
