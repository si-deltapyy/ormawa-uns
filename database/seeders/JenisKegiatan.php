<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Tambahkan ini

class JenisKegiatan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['jenis_kegiatan' => 'Pendelegasian Kompetisi'],
            ['jenis_kegiatan' => 'Pendelegasian Non Kompetisi'],
            ['jenis_kegiatan' => 'Penyelenggaraan Kompetisi'],
            ['jenis_kegiatan' => 'Penyelenggaraan Non Kompetisi'],
            ['jenis_kegiatan' => '(Bela Negara) - Pencegahan dan Penanganan Kekerasan Seksual (PPKS)'],
            ['jenis_kegiatan' => '(Bela Negara) - Program Kegiatan Pencegahan dan Penanganan Anti Intoleransi bagi Mahasiswa'],
            ['jenis_kegiatan' => '(Bela Negara) - Program Kegiatan Anti Perundungan bagi Mahasiswa'],
            ['jenis_kegiatan' => '(Bela Negara) - Program Kegiatan Anti Korupsi bagi Mahasiswa'],
            ['jenis_kegiatan' => '(Bela Negara) - Program Pembinaan Karakter/Softskill bagi Mahasiswa'],
            ['jenis_kegiatan' => '(Bela Negara) - Program Pembinaan Bela Negara bagi Mahasiswa'],
            ['jenis_kegiatan' => '(Bela Negara) - Program Pembinaan Wawasan Kebangsaan bagi mahasiswa'],
            ['jenis_kegiatan' => '(Bela Negara) - Program Pengembangan mental spiritual kebangsaan'],
            ['jenis_kegiatan' => '(Bela Negara) - Program Kampus Sehat/ Green Campus'],
            ['jenis_kegiatan' => '(MBKM Ormawa) - Program Mengajar di Sekolah'],
            ['jenis_kegiatan' => '(MBKM Ormawa) - Program Proyek Kemanusiaan'],
            ['jenis_kegiatan' => '(MBKM Ormawa) - Program Proyek Independen'],
            ['jenis_kegiatan' => '(MBKM Ormawa) - Program Membangun Desa'],
            ['jenis_kegiatan' => 'Pengembangan Ormawa'],
        ];

        DB::table('jenis_kegiatan')->insert($data);

    }
}