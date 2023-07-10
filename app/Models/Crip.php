<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crip extends Model
{
    use HasFactory;

    protected $fillable     = ['nama_crip', 'nilai_crip'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
    public function nilai()
    {
        return $this->belongsTo(NilaiAlternatif::class);
    }
}
