<?php

namespace Database\Seeders;

use App\Models\Ormawa;
use Illuminate\Database\Seeder;

class OrmawaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Masukkan semua data ke dalam array
        $ormawas = [
            ['UID' => 'U01', 'nama_ormawa' => 'Ormawa Kerohanian Islam JN UKMI', 'nama_id' => 'U01-Ormawa Kerohanian Islam JN UKMI'],
            ['UID' => 'U02', 'nama_ormawa' => 'Ormawa Kerohanian Islam Ilmu QurAn', 'nama_id' => 'U02-Ormawa Kerohanian Islam Ilmu Quran'],
            ['UID' => 'U03', 'nama_ormawa' => 'Ormawa Kerohanian Islam Seni Religi', 'nama_id' => 'U03-Ormawa Kerohanian Islam Seni Religi'],
            ['UID' => 'U04', 'nama_ormawa' => 'Ormawa Kerohanian Kristen', 'nama_id' => 'U04-Ormawa Kerohanian Kristen'],
            ['UID' => 'U05', 'nama_ormawa' => 'Ormawa Kerohanian Katholik', 'nama_id' => 'U05-Ormawa Kerohanian Katholik'],
            ['UID' => 'U06', 'nama_ormawa' => 'Ormawa Kerohanian Hindu', 'nama_id' => 'U06-Ormawa Kerohanian Hindu'],
            ['UID' => 'U07', 'nama_ormawa' => 'Ormawa Kerohanian Budha', 'nama_id' => 'U07-Ormawa Kerohanian Budha'],
            ['UID' => 'U08', 'nama_ormawa' => 'Ormawa Kerohanian Konghucu', 'nama_id' => 'U08-Ormawa Kerohanian Konghucu'],
            ['UID' => 'U09', 'nama_ormawa' => 'Ormawa Badan Eksekutif Mahasiswa', 'nama_id' => 'U09-Ormawa Badan Eksekutif Mahasiswa'],
            ['UID' => 'U10', 'nama_ormawa' => 'Ormawa Dewan Mahasiswa', 'nama_id' => 'U10-Ormawa Dewan Mahasiswa'],
            ['UID' => 'U11', 'nama_ormawa' => 'Ormawa Paduan Suara Mahasiswa Voca Erudita', 'nama_id' => 'U11-Ormawa Paduan Suara Mahasiswa Voca Erudita'],
            ['UID' => 'U12', 'nama_ormawa' => 'Ormawa Marching Band', 'nama_id' => 'U12-Ormawa Marching Band'],
            ['UID' => 'U13', 'nama_ormawa' => 'Ormawa Kesenian Tradisional', 'nama_id' => 'U13-Ormawa Kesenian Tradisional'],
            ['UID' => 'U14', 'nama_ormawa' => 'Ormawa Pencinta Alam Garba Wira Bhuana', 'nama_id' => 'U14-Ormawa Pencinta Alam Garba Wira Bhuana'],
            ['UID' => 'U16', 'nama_ormawa' => 'Ormawa Korps Sukarela Palang Merah Indonesia', 'nama_id' => 'U16-Ormawa Korps Sukarela Palang Merah Indonesia'],
            ['UID' => 'U17', 'nama_ormawa' => 'Ormawa Gerakan Pramuka Gudep Kota Surakarta ', 'nama_id' => 'U17-Ormawa Gerakan Pramuka Gudep Kota Surakarta '],
            ['UID' => 'U18', 'nama_ormawa' => 'Ormawa Pusat Informasi dan Komunikasi Remaja', 'nama_id' => 'U18-Ormawa Pusat Informasi dan Komunikasi Remaja'],
            ['UID' => 'U19', 'nama_ormawa' => 'Ormawa Studi Ilmiah Mahasiswa', 'nama_id' => 'U19-Ormawa Studi Ilmiah Mahasiswa'],
            ['UID' => 'U20', 'nama_ormawa' => 'Ormawa Student English Forum', 'nama_id' => 'U20-Ormawa Student English Forum'],
            ['UID' => 'U21', 'nama_ormawa' => 'Ormawa Aisec', 'nama_id' => 'U21-Ormawa Aisec'],
            ['UID' => 'U22', 'nama_ormawa' => 'Ormawa Lembaga Pers Mahasiswa Kentingan', 'nama_id' => 'U22-Ormawa Lembaga Pers Mahasiswa Kentingan'],
            ['UID' => 'U23', 'nama_ormawa' => 'Ormawa Robotika', 'nama_id' => 'U23-Ormawa Robotika'],
            ['UID' => 'U24', 'nama_ormawa' => 'Ormawa Koperasi Mahasiswa', 'nama_id' => 'U24-Ormawa Koperasi Mahasiswa'],
            ['UID' => 'U25', 'nama_ormawa' => 'Ormawa INKAI', 'nama_id' => 'U25-Ormawa INKAI'],
            ['UID' => 'U26', 'nama_ormawa' => 'Ormawa Sorinji Kempo', 'nama_id' => 'U26-Ormawa Sorinji Kempo'],
            ['UID' => 'U27', 'nama_ormawa' => 'Ormawa Taekwondo', 'nama_id' => 'U27-Ormawa Taekwondo'],
            ['UID' => 'U28', 'nama_ormawa' => 'Ormawa Pencak Silat Merpati Putih', 'nama_id' => 'U28-Ormawa Pencak Silat Merpati Putih'],
            ['UID' => 'U29', 'nama_ormawa' => 'Ormawa Pencak Silat Tapak Suci', 'nama_id' => 'U29-Ormawa Pencak Silat Tapak Suci'],
            ['UID' => 'U30', 'nama_ormawa' => 'Ormawa Pencak Silat Perisai Diri', 'nama_id' => 'U30-Ormawa Pencak Silat Perisai Diri'],
            ['UID' => 'U31', 'nama_ormawa' => 'Ormawa Pencak Silat PSHT', 'nama_id' => 'U31-Ormawa Pencak Silat PSHT'],
            ['UID' => 'U32', 'nama_ormawa' => 'Ormawa Sepakbola dan Futsal', 'nama_id' => 'U32-Ormawa Sepakbola dan Futsal'],
            ['UID' => 'U33', 'nama_ormawa' => 'Ormawa Bola Basket', 'nama_id' => 'U33-Ormawa Bola Basket'],
            ['UID' => 'U34', 'nama_ormawa' => 'Ormawa Bola Voli', 'nama_id' => 'U34-Ormawa Bola Voli'],
            ['UID' => 'U35', 'nama_ormawa' => 'Ormawa Bulutangkis', 'nama_id' => 'U35-Ormawa Bulutangkis'],
            ['UID' => 'U36', 'nama_ormawa' => 'Ormawa Tenis Lapangan', 'nama_id' => 'U36-Ormawa Tenis Lapangan'],
            ['UID' => 'U37', 'nama_ormawa' => 'Ormawa Tenis Meja', 'nama_id' => 'U37-Ormawa Tenis Meja'],
            ['UID' => 'U38', 'nama_ormawa' => 'Ormawa Komadiksi Smart', 'nama_id' => 'U38-Ormawa Komadiksi Smart'],
            ['UID' => 'U39', 'nama_ormawa' => 'Ormawa Pentaque', 'nama_id' => 'U39-Ormawa Pentaque'],
            ['UID' => 'U40', 'nama_ormawa' => 'Ormawa HMP Pascasarjana', 'nama_id' => 'U40-Ormawa HMP Pascasarjana'],
            ['UID' => 'U41', 'nama_ormawa' => 'Ormawa Society of Renewable Energy', 'nama_id' => 'U41-Ormawa Society of Renewable Energy'],
            ['UID' => 'U42', 'nama_ormawa' => 'Ormawa Judo', 'nama_id' => 'U42-Ormawa Judo'],
            ['UID' => 'U43', 'nama_ormawa' => 'Ormawa Pagar Nusa', 'nama_id' => 'U43-Ormawa Pagar Nusa'],
            ['UID' => 'U44', 'nama_ormawa' => 'Ormawa E-Sport', 'nama_id' => 'U44-Ormawa E-Sport'],
            ['UID' => 'U45', 'nama_ormawa' => 'Ormawa Aquatic', 'nama_id' => 'U45-Ormawa Aquatic'],
            ['UID' => 'U46', 'nama_ormawa' => 'Ormawa Sepak Takraw', 'nama_id' => 'U46-Ormawa Sepak Takraw'],
            ['UID' => 'U47', 'nama_ormawa' => 'Ormawa Bengawan Team', 'nama_id' => 'U47-Ormawa Bengawan Team'],
            ['UID' => 'U48', 'nama_ormawa' => 'Ormawa Catur', 'nama_id' => 'U48-Ormawa Catur'],
            ['UID' => 'U99', 'nama_ormawa' => 'Non-Ormawa', 'nama_id' => 'U99-Non-Ormawa'],
            ['UID' => 'U49', 'nama_ormawa' => 'Ormawa Fakultas', 'nama_id' => 'U49-Ormawa Fakultas'],
        ];

        // Loop data array dan masukkan ke database
        foreach ($ormawas as $data) {
            // updateOrCreate akan mengecek 'UID'. 
            // Jika UID sudah ada, data akan diupdate. Jika belum, akan dibuat baru.
            Ormawa::updateOrCreate(
                ['UID' => $data['UID']], // Key unik pengecekan
                [
                    'nama_ormawa' => $data['nama_ormawa'],
                    'nama_id' => $data['nama_id']
                ]
            );
        }
    }
}
