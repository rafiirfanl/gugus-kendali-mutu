<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilTemuan extends Model
{
    use HasFactory;

    protected $table = 'hasil_temuans';

    protected $fillable = [
        'subkriteria_id',
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
