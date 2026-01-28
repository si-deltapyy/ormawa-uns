<?php

namespace Database\Seeders;

use App\Models\mak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MAKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Masukkan data ke dalam Array agar rapi
        $daftarMak = [
            [
                'kode_mak' => '51020101', 
                'nama_belanja' => 'Honorarium Non UNS'
            ],
            [
                'kode_mak' => '51040403', 
                'nama_belanja' => 'BBM, Beban Habis Pakai Kegiatan, Bantuan Hadiah Penyelenggaraan Lomba'
            ],
            [
                'kode_mak' => '51030210', 
                'nama_belanja' => 'Percetakan'
            ],
            [
                'kode_mak' => '51030305', 
                'nama_belanja' => 'Sewa Properti'
            ],
            [
                'kode_mak' => '51030303', 
                'nama_belanja' => 'Sewa Kendaraan dan Alat Angkutan'
            ],
            [
                'kode_mak' => 'XXXXXX04', 
                'nama_belanja' => 'Pengalihan Anggaran'
            ],
            [
                'kode_mak' => '51040103', 
                'nama_belanja' => 'Biaya Perjalanan Dinas Non Pegawai Dalam Negeri'
            ],
            [
                'kode_mak' => '51040104', 
                'nama_belanja' => 'Biaya Perjalanan Dinas Non Pegawai Luar Negeri'
            ],
            [
                'kode_mak' => '51040101', 
                'nama_belanja' => 'Biaya Perjalanan Dinas Pegawai Dalam Negeri'
            ],
            [
                'kode_mak' => '51040102', 
                'nama_belanja' => 'Biaya Perjalanan Dinas Pegawai Luar Negeri'
            ],
            [
                'kode_mak' => '51030403', 
                'nama_belanja' => 'Biaya Registrasi'
            ],
        ];

        foreach ($daftarMak as $data) {
            mak::updateOrCreate(
                ['kode_mak' => $data['kode_mak']], // Kunci pengecekan
                ['nama_belanja' => $data['nama_belanja']] // Data yang diupdate/create
            );
        }
    }
}