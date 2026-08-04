<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subkriteria extends Model
{
    use HasFactory;

    protected $table = 'subkriterias';
    protected $fillable = ['kriteria_id', 'kode'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function hasilTemuans()
    {
        return $this->hasMany(HasilTemuan::class);
    }
}
