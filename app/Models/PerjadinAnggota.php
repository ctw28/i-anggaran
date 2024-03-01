<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjadinAnggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'perjadin_id',
        'nama',
        'nip',
        'jabatan',
    ];

    public function perjadin()
    {
        return $this->belongsTo('App\Models\Perjadin');
    }
    public function rincian()
    {
        return $this->hasOne('App\Models\PerjadinRincian');
    }
    public function realCost()
    {
        return $this->hasOne('App\Models\PerjadinRealCost');
    }
}
