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
            'kode_skim' => '131281',
            'nama_skim' => 'Delegasi Nasional Non Puspresnas',
        ]);
        Skim::create([
            'kode_skim' => '131280',
            'nama_skim' => 'Delegasi Internasional',
        ]);
        Skim::create([
            'kode_skim' => '131095',
            'nama_skim' => 'Delegasi Puspresnas',
        ]);
        Skim::create([
            'kode_skim' => '131287',
            'nama_skim' => 'Penyelenggaraan Kegiatan Mahasiswa',
        ]);
    }
}
