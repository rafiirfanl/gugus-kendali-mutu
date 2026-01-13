<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TindakLanjut extends Model
{
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
