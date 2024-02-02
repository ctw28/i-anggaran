<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaBerita extends Model
{
    use HasFactory;
    protected $fillable = [
        'periksa_sesi_id',
        'tanggal',
        'nomor',
    ];

    public function periksaSesi()
    {
        return $this->belongsTo('App\Models\PeriksaSesi');
    }
}
