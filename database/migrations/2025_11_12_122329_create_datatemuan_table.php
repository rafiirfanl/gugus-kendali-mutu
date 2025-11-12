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
        Schema::create('data_temuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_kriteria_id')->nullable();
            $table->text('hasil_temuan');
            $table->string('status_tahun_lalu');
            $table->string('status_tahun_ini');
            $table->text('kendala')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->text('masukkan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_temuans');
    }
};
