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
            'kode_skim' => 'PR',
            'nama_skim' => 'Delegasi Lomba (Eksternal / Internal)',
        ]);
        Skim::create([
            'kode_skim' => 'RG',
            'nama_skim' => 'Kegiatan Rekognisi Non Lomba',
        ]);
        Skim::create([
            'kode_skim' => 'MB',
            'nama_skim' => 'Kegiatan MBKM',
        ]);
        Skim::create([
            'kode_skim' => 'BN',
            'nama_skim' => 'Kegiatan Bela Negara',
        ]);
        Skim::create([
            'kode_skim' => 'LL',
            'nama_skim' => 'Lainnya',
        ]);
    }
}
