<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mekanisme_rancangan', function (Blueprint $table) {
            $table->id();
            $table->date('persiapan_tanggal');
            $table->string('persiapan_tempat');
            $table->time('persiapan_waktu');
            $table->text('persiapan_deskripsi')->nullable();
            $table->date('pelaksanaan_tanggal');
            $table->string('pelaksanaan_tempat');
            $table->string('pelaksanaan_waktu');
            $table->text('pelaksanaan_deskripsi')->nullable();
            $table->date('evaluasi_tanggal');
            $table->string('evaluasi_tempat');
            $table->string('evaluasi_waktu');
            $table->text('evaluasi_deskripsi')->nullable();
            $table->date('pelaporan_tanggal');
            $table->string('pelaporan_tempat');
            $table->string('pelaporan_waktu');
            $table->text('pelaporan_deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('proker', function (Blueprint $table) {
            $table->id();
            $table->string('id_kegiatan', 50)->unique();
            $table->unsignedBigInteger('id_ormawa');
            $table->string('id_skim', 10);
            $table->unsignedBigInteger('id_jenis_kegiatan');
            $table->string('nama_kegiatan');
            $table->enum('sasaran_kegiatan', ['Mahasiswa Internal', 'Mahasiswa dan Umum', 'Mahasiswa Internal dan Eksternal', 'Lainnya']);
            $table->string('lainnya')->nullable(); //untuk deskripsi lainnya
            $table->string('id_luaran_kegiatan');
            $table->string('target_luaran');
            $table->string('tahun_anggaran', 4);
            $table->text('latar_belakang');
            $table->text('tujuan_kegiatan');
            $table->text('rasionalisasi_kegiatan');
            $table->text('keberlanjutan_kegiatan');
            $table->unsignedBigInteger('id_mekanisme_rancangan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('nama_pic');
            $table->string('nim_pic');
            $table->string('kontak_pic');
            $table->enum('status_proker', ['Diajukan', 'Disetujui', 'Ditolak', 'Proses Pembina', 'Revisi', 'Review'])->default('Diajukan');
            $table->enum('status_pelaksanaan', ['Belum Dilaksanakan', 'Sedang Dilaksanakan', 'Selesai'])->default('Belum Dilaksanakan');
            $table->enum('status_laporan', ['Belum Diupload', 'Sudah Diupload'])->default('Belum Diupload');
            $table->enum('status_aktif', ['Aktif', 'Tidak Aktif', 'Belum Aktif'])->default('Belum Aktif');
            $table->enum('verifikasi_admin', ['Terverifikasi', 'Belum Terverifikasi'])->default('Belum Terverifikasi');
            $table->enum('status_rab', ['Disetujui', 'Ditolak', 'Menunggu', 'Belum Mengajukan'])->default('Belum Mengajukan');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('id_ormawa')->references('id')->on('ormawa')->onDelete('cascade');
            $table->foreign('id_jenis_kegiatan')->references('id')->on('jenis_kegiatan')->onDelete('cascade');
            $table->foreign('id_mekanisme_rancangan')->references('id')->on('mekanisme_rancangan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proker');
        Schema::dropIfExists('mekanisme_rancangan');
    }
};
