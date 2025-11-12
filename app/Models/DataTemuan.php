<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTemuan extends Model
{
    /** @use HasFactory<\Database\Factories\DataTemuanFactory> */
    use HasFactory;

    protected $table = 'data_temuans';
    protected $fillable = [
    'id_sub_kriteria',
    'hasil_temuan',
    'status_tahun_lalu',
    'status_tahun_ini',
    'kendala',
    'tindak_lanjut',
    'masukkan',
    ];
}
