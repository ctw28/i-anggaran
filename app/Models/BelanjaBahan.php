<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BelanjaBahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokumen_pencairan_sesi_id',
        'item',
        'nilai',
        'ppn',
        'pph',
        'jenis',
        'urutan',
    ];

    public function pencairanSesi()
    {
        return $this->belongsTo('App\Models\DokumenPencairanSesi');
    }
}
