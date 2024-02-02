<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'periksa_sesi_id',
        'catatan',
    ];

    public function periksaSesi()
    {
        return $this->belongsTo('App\Models\PeriksaSesi');
    }
}
