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
        Schema::create('proker', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ormawa');
            $table->string('jenis_kegiatan');
            $table->string('kategori_kegiatan');
            $table->bigInteger('skim_kegiatan');
            $table->string('nama_kegiatan');
            $table->string('tingkat_kegiatan');
            $table->string('nama_pic');
            $table->string('nim_pic');
            $table->string('kontak_pic');
            $table->date('mulai');
            $table->date('selesai');
            $table->string('sumber_dana');
            $table->string('jumlah_dana');
            $table->string('filenames');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proker');
    }
};
