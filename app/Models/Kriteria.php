<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'atribut',
        'bobot',
    ];

    public function crip()
    {
        return $this->hasMany(Crip::class);
    }
}
