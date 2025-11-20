<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    /** @use HasFactory<\Database\Factories\MatkulFactory> */
    use HasFactory;

    protected $table = 'matkuls';
    protected $fillable = [
        'nama_matkul',
        'kode_matkul',
        'bobot_sks',
        'praktikum',
        'prodi_id',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }
}
