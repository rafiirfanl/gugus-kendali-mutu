<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    /** @use HasFactory<\Database\Factories\TahunAjaranFactory> */
    use HasFactory;

    protected $table = 'tahun_ajarans';
    protected $fillable = [
        'tahun_ajaran',
        'jenis',
        'tanggal_mulai_kuliah',
        'is_aktif',
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function matkulDibuka()
    {
        return $this->hasMany(MatkulDibuka::class);
    }

}
