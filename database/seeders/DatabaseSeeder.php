<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MAKSeeder::class,
            OrmawaSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            SubKegiatanSeeder::class,
            TimelineSeeder::class,
            JenisKegiatan::class,
            LuaranSeeder::class,
            CreateSkimsSeeder::class,
        ]);
    }
}
