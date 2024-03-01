<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjadinRealCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'perjadin_anggota_id',
        'item',
        'nilai',
        'jenis',
    ];

    public function anggota()
    {
        return $this->belongsTo('App\Models\PerjadinAnggota');
    }
}
