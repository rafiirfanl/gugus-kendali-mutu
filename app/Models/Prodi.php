<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    /** @use HasFactory<\Database\Factories\ProdiFactory> */
    use HasFactory;

    protected $table = 'prodis';
    protected $fillable = [
        'nama_prodi',
        'kode_prodi',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function matkuls()
    {
        return $this->hasMany(Matkul::class);
    }
}
