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
        Schema::create('indikator_utama', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ormawa_id');
            $table->string('pendelegasian_kompetisi_realisasi');
            $table->string('pendelegasian_kompetisi_target');
            $table->string('pendelegasian_non_kompetisi_realisasi');
            $table->string('pendelegasian_non_kompetisi_target');
            $table->string('penyelenggaraan_kompetisi_realisasi');
            $table->string('penyelenggaraan_kompetisi_target');
            $table->string('penyelenggaraan_non_kompetisi_realisasi');
            $table->string('penyelenggaraan_non_kompetisi_target');
            $table->string('sdg_realisasi');
            $table->string('sdg_target');
            $table->timestamps();

            $table->foreign('ormawa_id')->references('id')->on('ormawa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_utama');
    }
};
