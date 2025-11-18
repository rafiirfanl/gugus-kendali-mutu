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
        Schema::create('dokumen_perkuliahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokumen_id')->nullable();
            $table->string('nama_dokumen');
            $table->integer('sesi');
            $table->integer('tenggat_waktu_default')->nullable();
            $table->string('dikumpulkan_per')->nullable();
            $table->string('template')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_perkuliahans');
    }
};
