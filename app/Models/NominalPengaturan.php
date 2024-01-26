<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominalPengaturan extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokumen_pencairan_sesi_id',
        'is_non_satker',
    ];

    public function dokumenPencairsanSesi()
    {
        return $this->belongsTo('App\Models\DokumenPencairanSesi');
    }
}
