<?php

namespace Database\Seeders;

use App\Models\IndikatorKinerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Validation\Rules\In;

class IndikatorKinerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // IK 27 - P 32
        IndikatorKinerja::create([
            'kode_kinerja' => 'IK-27',
            'nama_kinerja' => 'Mahasiswa melakukan magang/praktek kerja wajib dan kegiatan magang/praktek kerja lainnya',
            'group_skim_id' => null,
            'kode_program' => 'P-32',
            'nama_program' => 'Peningkatan jumlah mahasiswa melakukan magang/praktek kerja wajib dan kegiatan magang/praktek kerja lainnya',
        ]);

        // IK 28 - P 33
        IndikatorKinerja::create([
            'kode_kinerja' => 'IK-28',
            'nama_kinerja' => 'Mahasiswa mengikuti program mahasiswa berdampak (program sosial/pengabdian kepada masyarakat untuk pemberdayaan masyarakat di pedesaan atau daerah terpencil) KKN dan kegiatan mahasiswa berdampak lainnya',
            'group_skim_id' => 1,
            'kode_program' => 'P-33',
            'nama_program' => 'Peningkatan jumlah mahasiswa mengikuti program mahasiswa berdampak (program sosial/pengabdian kepada masyarakat untuk pemberdayaan masyarakat di pedesaan atau daerah terpencil) KKN dan kegiatan mahasiswa berdampak lainnya',
        ]);

        // IK 29 - P 34
        IndikatorKinerja::create([
            'kode_kinerja' => 'IK-29',
            'nama_kinerja' => 'Mahasiswa mengikuti program pertukaran mahasiswa kampus luar negeri',
            'group_skim_id' => 1,
            'kode_program' => 'P-34',
            'nama_program' => 'Peningkatan jumlah mahasiswa mengikuti program pertukaran mahasiswa kampus luar negeri',
        ]);

        // IK 30 - P 35
        IndikatorKinerja::create([
            'kode_kinerja' => 'IK-30',
            'nama_kinerja' => 'Mahasiswa meraih prestasi tingkat provinsi',
            'group_skim_id' => 1,
            'kode_program' => 'P-35',
            'nama_program' => 'Peningkatan mahasiswa meraih prestasi tingkat provinsi',
        ]);

        // IK 31 - P 36
        IndikatorKinerja::create([
            'kode_kinerja' => 'IK-31',
            'nama_kinerja' => 'Mahasiswa meraih prestasi tingkat nasional',
            'group_skim_id' => 1,
            'kode_program' => 'P-36',
            'nama_program' => 'Peningkatan mahasiswa meraih prestasi tingkat nasional',
        ]);

        // IK 32 - P 37
        IndikatorKinerja::create([
            'kode_kinerja' => 'IK-32',
            'nama_kinerja' => 'Mahasiswa meraih prestasi tingkat Internasional',
            'group_skim_id' => 1,
            'kode_program' => 'P-37',
            'nama_program' => 'Peningkatan mahasiswa meraih prestasi tingkat Internasional',
        ]);

        // IK 33 - P 38
        IndikatorKinerja::create([
            'kode_kinerja' => 'IK-33',
            'nama_kinerja' => 'Dampak partisipasi mahasiswa atas kegiatan di luar kampus terhadap pengembangan kompetensi',
            'group_skim_id' => 1,
            'kode_program' => 'P-38',
            'nama_program' => 'Peningkatan dampak partisipasi mahasiswa atas kegiatan di luar kampus terhadap pengembangan kompetensi',
        ]);

        // IK 34 - P 39
        IndikatorKinerja::create([
            'kode_kinerja' => 'IK-34',
            'nama_kinerja' => 'Skema exposure internasional yang dikembangkan untuk mahasiswa',
            'group_skim_id' => null,
            'kode_program' => 'P-39',
            'nama_program' => 'Peningkatan jumlah skema exposure internasional untuk mahasiswa',
        ]);

        // IK 35 - P 40
        IndikatorKinerja::create([
            'kode_kinerja' => 'IK-35',
            'nama_kinerja' => 'Pembahasan isu yang berkaitan dengan mahasiswa melalui dialog bersama mahasiswa',
            'group_skim_id' => null,
            'kode_program' => 'P-40',
            'nama_program' => 'Peningkatan pembahasan isu yang berkaitan dengan mahasiswa melalui dialog bersama mahasiswa',
        ]);



    }
}
