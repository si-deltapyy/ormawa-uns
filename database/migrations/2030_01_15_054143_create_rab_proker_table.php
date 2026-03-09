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
            $table->string('uraian_belanja');
            $table->integer('volume');
            $table->integer('frekuensi');
            $table->integer('perhitungan');
            $table->integer('tahun_anggaran');
            $table->string('harga_satuan');
            $table->string('total_biaya');
            $table->text('catatan')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->timestamps();

            $table->foreign('proker_id')->references('id')->on('proker')->onDelete('cascade');
            $table->foreign('mak_id')->references('id')->on('mak')->onDelete('cascade');
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
