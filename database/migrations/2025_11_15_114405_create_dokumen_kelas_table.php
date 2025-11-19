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
        Schema::create('dokumen_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('kelas_id')->nullable();
            $table->foreignId('dokumen_perkuliahan_id')->nullable();
            $table->string('file_dokumen')->nullable();
            $table->dateTime('waktu_pengumpulan')->nullable();
            $table->enum('status', ['dikumpulkan', 'ditolak'])->default('dikumpulkan');
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_kelas');
    }
};
