<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPerkuliahan extends Model
{
    /** @use HasFactory<\Database\Factories\DokumenPerkuliahanFactory> */
    use HasFactory;

    protected $table = 'dokumen_perkuliahans';
    protected $fillable = [
        'nama_dokumen',
        'sesi',
        'tenggat_waktu_default',
        'template',
    ];

    public function dokumenKelas()
    {
        return $this->hasMany(DokumenKelas::class, 'dokumen_perkuliahan_id', 'id');
    }
}
