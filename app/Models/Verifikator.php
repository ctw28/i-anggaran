<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifikator extends Model
{
    use HasFactory;
    protected $fillable = [
        'pegawai_id',
        'sebutan_jabatan',
        'is_aktif',
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai');
    }
    public function periksaSesi()
    {
        return $this->hasMany('App\Models\PeriksaSesi');
    }
}
