<?php

namespace Database\Seeders;

use App\Models\TargetSkim;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateTargetSkimsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TargetSkim::create([
            'kode_skim' => 'PR.01',
            'slug' => 'Juara',
        ]);
        TargetSkim::create([
            'kode_skim' => 'PR.02',
            'slug' => 'Apresiasi/ Juara Umum',
        ]);
        TargetSkim::create([
            'kode_skim' => 'PR.03',
            'slug' => 'Peserta',
        ]);

        TargetSkim::create([
            'kode_skim' => 'RG.01',
            'slug' => 'Pembicara/Narasumber Seminar',
        ]);
        TargetSkim::create([
            'kode_skim' => 'RG.02',
            'slug' => 'Speaker Seminar',
        ]);
        TargetSkim::create([
            'kode_skim' => 'RG.03',
            'slug' => 'Peserta Pameran',
        ]);
        TargetSkim::create([
            'kode_skim' => 'RG.04',
            'slug' => 'Penulis Pertama Publikasi Karya Ilmiah',
        ]);
        TargetSkim::create([
            'kode_skim' => 'RG.05',
            'slug' => 'Penulis Buku ISBN',
        ]);
        TargetSkim::create([
            'kode_skim' => 'RG.06',
            'slug' => 'Wasit/ Juri',
        ]);
        TargetSkim::create([
            'kode_skim' => 'RG.07',
            'slug' => 'Pelatih',
        ]);
        TargetSkim::create([
            'kode_skim' => 'RG.08',
            'slug' => 'Penerbitan HAKI',
        ]);


        TargetSkim::create([
            'kode_skim' => 'MB.01',
            'slug' => 'Pertukaran Pelajar',
        ]);
        TargetSkim::create([
            'kode_skim' => 'MB.02',
            'slug' => 'Magang/Praktik Kerja',
        ]);
        TargetSkim::create([
            'kode_skim' => 'MB.03',
            'slug' => 'Asistensi Mengajar di Satuan Pendidikan',
        ]);
        TargetSkim::create([
            'kode_skim' => 'MB.04',
            'slug' => 'Penelitian/Riset',
        ]);
        TargetSkim::create([
            'kode_skim' => 'MB.05',
            'slug' => 'Proyek Kemanusiaan',
        ]);
        TargetSkim::create([
            'kode_skim' => 'MB.06',
            'slug' => 'Kegiatan Wirausaha',
        ]);
        TargetSkim::create([
            'kode_skim' => 'MB.07',
            'slug' => 'Studi/Proyek Independen',
        ]);
        TargetSkim::create([
            'kode_skim' => 'MB.08',
            'slug' => 'Membangun Desa/Kuliah Kerja Nyata Tematik',
        ]);

        TargetSkim::create([
            'kode_skim' => 'BN.01',
            'slug' => 'Pencegahan dan Penanganan Kekerasan Seksual (PPKS)',
        ]);
        TargetSkim::create([
            'kode_skim' => 'BN.02',
            'slug' => 'Program Kegiatan Pencegahan dan Penanganan Anti Intoleransi bagi Mahasiswa',
        ]);
        TargetSkim::create([
            'kode_skim' => 'BN.03',
            'slug' => 'Program Kegiatan Anti Perundungan bagi Mahasiswa',
        ]);
        TargetSkim::create([
            'kode_skim' => 'BN.04',
            'slug' => 'Program Kegiatan Anti Korupsi bagi Mahasiswa',
        ]);
        TargetSkim::create([
            'kode_skim' => 'BN.05',
            'slug' => 'Pembinaan Kewirausahaan Mahasiswa',
        ]);
        TargetSkim::create([
            'kode_skim' => 'BN.06',
            'slug' => 'Program Pembinaan Karakter bagi Mahasiswa',
        ]);
        TargetSkim::create([
            'kode_skim' => 'BN.07',
            'slug' => 'Program Pembinaan Bela Negara bagi Mahasiswa',
        ]);
        TargetSkim::create([
            'kode_skim' => 'BN.08',
            'slug' => 'Program Pembinaan Wawasan Kebangsaan bagi mahasiswa',
        ]);
        TargetSkim::create([
            'kode_skim' => 'BN.09',
            'slug' => 'Program Pengembangan mental spiritual kebangsaan',
        ]);

        TargetSkim::create([
            'kode_skim' => 'LL',
            'slug' => 'Lainnya',
        ]);
    }
}
