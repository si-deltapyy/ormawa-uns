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
        Schema::create('rab_proker', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proker_id');
            $table->unsignedBigInteger('mak_id');
            $table->integer('volume');
            $table->integer('frekuensi');
            $table->integer('jumlah_kegiatan');
            $table->integer('tahun_anggaran');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('total_biaya', 15, 2);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rab_proker');
    }
};
