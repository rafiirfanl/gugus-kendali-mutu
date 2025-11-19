<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenKelas extends Model
{
    /** @use HasFactory<\Database\Factories\DokumenKelasFactory> */
    use HasFactory;

    protected $table = 'dokumen_kelas';
     protected $fillable = [
        'kelas_id',
        'dokumen_perkuliahan_id',
        'file_dokumen',
        'waktu_pengumpulan',
        'status',
        'catatan',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function dokumenPerkuliahan()
    {
        return $this->belongsTo(DokumenPerkuliahan::class, 'dokumen_perkuliahan_id');
    }
}
