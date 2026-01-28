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
        Schema::create('logs_ajuan_proker', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proker_id');
            $table->enum('action', ['created', 'updated', 'deleted', 'approved', 'rejected']);
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('proker_id')->references('id')->on('proker')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs_ajuan_proker');
    }
};
