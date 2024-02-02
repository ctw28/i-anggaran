<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaDaftarTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_template',
        'is_aktif',
    ];

    public function periksaDaftar()
    {
        return $this->hasMany('App\Models\PeriksaDaftar');
    }
}
