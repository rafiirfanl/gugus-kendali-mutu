<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';
    protected $fillable = ['nama', 'deskripsi'];

    public function subkriterias()
    {
        return $this->hasMany(Subkriteria::class);
    }
}
