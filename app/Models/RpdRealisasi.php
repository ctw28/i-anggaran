<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RpdRealisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'rpd_id',
        'pencairan_sesi_id',
        'realisasi',
    ];

    public function rpd()
    {
        return $this->belongsTo('App\Models\Rpd');
    }
    public function pencairan()
    {
        return $this->belongsTo('App\Models\Pencairan');
    }
}
