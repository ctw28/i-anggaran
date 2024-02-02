<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifikator extends Model
{
    use HasFactory;
    protected $fillable = [
        'organisasi_jabatan_sesi_id',
        'sebutan_jabatan',
        'is_aktif',
    ];

    public function organisasiJabatanSesi()
    {
        return $this->belongsTo('App\Models\OrganisasiJabatanSesi');
    }
    public function periksaSesi()
    {
        return $this->hasMany('App\Models\PeriksaSesi');
    }
}
