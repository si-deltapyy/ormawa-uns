<?php

namespace Database\Seeders;

use App\Models\SDG;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SdgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        SDG::create(['nama_sdgs' => 'SDGs 4: Pendidikan Berkualitas', 'nomor_sdgs' => 4]);
        SDG::create(['nama_sdgs' => 'SDGs 17: Kemitraan / Kerjasama', 'nomor_sdgs' => 17]);
        SDG::create(['nama_sdgs' => 'SDGs 1: Pengentasan Kemiskinan', 'nomor_sdgs' => 1]);
        SDG::create(['nama_sdgs' => 'SDGs 3: Kesehatan dan Kesejahteraan', 'nomor_sdgs' => 3]);
        SDG::create(['nama_sdgs' => 'SDGs 8: Pertumbuhan Ekonomi', 'nomor_sdgs' => 8]);
    }
}
