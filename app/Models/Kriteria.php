<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriterias';
    protected $fillable = ['nama'];

    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class);
    }
}
