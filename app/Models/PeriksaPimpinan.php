<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaPimpinan extends Model
{
    use HasFactory;

    protected $fillable = [
        'periksa_sesi_id',
        'validasi_sekretaris',
        'validasi_ketua',
        'catatan_sekretaris',
        'catatan_ketua',
    ];

    public function periksaSesi()
    {
        return $this->belongsTo('App\Models\PeriksaSesi');
    }
}
