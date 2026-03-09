<?php

namespace Database\Seeders;

use App\Models\Skim;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateSkimsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Skim::create([
            'nama_skim' => 'Pendelegasian Kompetisi',
        ]);
        Skim::create([
            'nama_skim' => 'Pendelegasian Non Kompetisi',
        ]);
        Skim::create([
            'nama_skim' => 'Penyelenggaraan Kompetisi',
        ]);
        Skim::create([
            'nama_skim' => 'Penyelenggaraan Non Kompetisi',
        ]);
    }
}
