<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilTemuan extends Model
{
    protected $table = 'hasil_temuans';

    protected $fillable = [
        'prodi_id',
        'hasil_temuan',
    ];

    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class);
    }

    public function tindakLanjuts()
    {
        return $this->hasMany(TindakLanjut::class);
    }
}
