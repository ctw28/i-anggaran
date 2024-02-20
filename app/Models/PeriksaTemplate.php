<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_template',
        'is_default',
    ];

    public function periksaDaftar()
    {
        return $this->hasMany('App\Models\PeriksaDaftar');
    }
}
