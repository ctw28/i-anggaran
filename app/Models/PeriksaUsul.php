<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaUsul extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokumen_pencairan_sesi_id',
        'is_finish',
        'catatan',
    ];

    public function pencairanSesi()
    {
        return $this->belongsTo('App\Models\DokumenPencairanSesi');
    }
    public function periksaSesi()
    {
        return $this->hasOne('App\Models\PeriksaSesi');
    }
}
