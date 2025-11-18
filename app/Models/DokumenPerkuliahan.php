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
        //'dokumen_id',
        'nama_dokumen',
        'sesi',
        'tenggat_waktu_default',
        'dikumpulkan_per',
        'template',
    ];
}
