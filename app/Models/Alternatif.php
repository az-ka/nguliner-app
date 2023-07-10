<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $fillable = ['kode_alternatif', 'nama_alternatif', 'deskripsi', 'rating', 'total', 'maps'];

    public function crip()
    {
        return $this->belongsToMany(Crip::class, 'nilai_alternatifs', 'alternatif_id', 'crip_id');
    }
}
