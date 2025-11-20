<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    /** @use HasFactory<\Database\Factories\KelasFactory> */
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = [
        'nama_kelas',
        'dosen_id',
        'matkul_dibuka_id',
        'tahun_ajaran_id',
    ];

    public function matkulDibuka()
    {
        return $this->belongsTo(MatkulDibuka::class, 'matkul_dibuka_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function dokumenKelas()
    {
        return $this->hasMany(DokumenKelas::class, 'kelas_id');
    }
}
