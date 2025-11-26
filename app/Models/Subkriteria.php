<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    protected $table = 'subkriterias';
    protected $fillable = ['kriteria_id', 'kode'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function hasilTemuan()
    {
        return $this->hasMany(HasilTemuan::class);
    }
}
