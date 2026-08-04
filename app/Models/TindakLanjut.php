<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TindakLanjut extends Model
{
    use HasFactory;

    protected $table = 'tindak_lanjuts';

    protected $fillable = [
        'prodi_id',
        'hasil_temuan_id',
        'tindak_lanjut',
        'kendala',
        'masukan',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function hasilTemuan()
    {
        return $this->belongsTo(HasilTemuan::class);
    }
}
