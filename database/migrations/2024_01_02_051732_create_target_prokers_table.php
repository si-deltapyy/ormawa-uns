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
        Schema::create('target_prokers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('number');
            $table->bigInteger('ormawa');
            $table->integer('PR01')->nullable();
            $table->integer('PR02')->nullable();
            $table->integer('RG01')->nullable();
            $table->integer('RG02')->nullable();
            $table->integer('RG03')->nullable();
            $table->integer('RG04')->nullable();
            $table->integer('RG05')->nullable();
            $table->integer('RG06')->nullable();
            $table->integer('RG07')->nullable();
            $table->integer('RG08')->nullable();
            $table->integer('MB01')->nullable();
            $table->integer('MB02')->nullable();
            $table->integer('MB03')->nullable();
            $table->integer('MB04')->nullable();
            $table->integer('MB05')->nullable();
            $table->integer('MB06')->nullable();
            $table->integer('MB07')->nullable();
            $table->integer('MB08')->nullable();
            $table->integer('BN01')->nullable();
            $table->integer('BN02')->nullable();
            $table->integer('BN03')->nullable();
            $table->integer('BN04')->nullable();
            $table->integer('BN05')->nullable();
            $table->integer('BN06')->nullable();
            $table->integer('BN07')->nullable();
            $table->integer('BN08')->nullable();
            $table->integer('BN09')->nullable();
            $table->integer('LL')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_prokers');
    }
};
