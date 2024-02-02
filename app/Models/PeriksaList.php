<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaList extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_list',
        'keterangan',
    ];

    public function periksaDaftar()
    {
        return $this->hasMany('App\Models\PeriksaDaftar');
    }
}
