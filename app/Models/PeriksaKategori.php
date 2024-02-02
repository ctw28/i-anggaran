<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaKategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
        'keterangan',
    ];

    public function periksaDaftar()
    {
        return $this->hasMany('App\Models\PeriksaDaftar');
    }
}
