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
        Schema::create('matkul_dibukas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matkul_id');
            $table->foreignId('tahun_ajaran_id');
            $table->integer('jumlah_kelas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matkul_dibukas');
    }
};
