<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LuaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_luaran' => 'Mahasiswa Prestasi Kejuaraan'],
            ['nama_luaran' => 'HAKI Mahasiswa'],
            ['nama_luaran' => 'Mahasiswa Sebagai Wasit Kompetisi Nasional'],
            ['nama_luaran' => 'Mahasiswa Sebagai Wasit Kompetisi Internasional'],
            ['nama_luaran' => 'Mahasiswa Sebagai Juri Kompetisi Nasional'],
            ['nama_luaran' => 'Mahasiswa Sebagai Juri Kompetisi Internasional'],
            ['nama_luaran' => 'Mahasiswa Sebagai Pelatih Nasional'],
            ['nama_luaran' => 'Mahasiswa Sebagai Pelatih Internasional'],
            ['nama_luaran' => 'Mahasiswa Sebagai Pembicara Nasional'],
            ['nama_luaran' => 'Mahasiswa Sebagai Pembicara Internasional'],
            ['nama_luaran' => 'Mahasiswa Sebagai Peserta Pameran Nasional'],
            ['nama_luaran' => 'Mahasiswa Sebagai Peserta Pameran Internasional'],
            ['nama_luaran' => 'Produk Karya Mahasiswa'],
            ['nama_luaran' => 'Publikasi Jurnal Ilmiah Nasional'],
            ['nama_luaran' => 'Publikasi Jurnal Ilmiah Internasional'],
            ['nama_luaran' => 'Buku ISBN/ ISSN'],
            ['nama_luaran' => 'Sertifikasi Kompetensi Mahasiswa Nasional'],
            ['nama_luaran' => 'Sertifikasi Kompetensi Mahasiswa Internasional'],
            ['nama_luaran' => 'Mahasiswa Pelaksana Kegiatan MBKM Ormawa'],
            ['nama_luaran' => 'Mahasiswa Pelaksana Kegiatan Bela Negara (BN)'],
            ['nama_luaran' => 'Mahasiswa Pelaksana Kegiatan Pengembangan Ormawa'],
        ];

        // Ganti 'jenis_luarans' dengan nama tabel yang sesuai di database Anda
        DB::table('luaran')->insert($data);
    }
}
