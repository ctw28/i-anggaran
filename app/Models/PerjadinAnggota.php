<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjadinAnggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'pencairan_id',
        'nama',
        'nip',
        'jabatan',
    ];

    public function pencairan()
    {
        return $this->belongsTo('App\Models\Pencairan');
    }
    public function rincian()
    {
        return $this->hasOne('App\Models\PerjadinRincian');
    }
    public function realCost()
    {
        return $this->hasMany('App\Models\PerjadinRealCost');
    }
}
