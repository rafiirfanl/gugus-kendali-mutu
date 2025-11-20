<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatkulDibuka extends Model
{
    /** @use HasFactory<\Database\Factories\MatkulDibukaFactory> */
    use HasFactory;

    protected $table = 'matkul_dibukas';
    protected $fillable = [
        'matkul_id',
        'tahun_ajaran_id',
        'jumlah_kelas',
    ];

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'matkul_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
}
