<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BelanjaBahanPerusahaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokumen_pencairan_sesi_id',
        'is_ada_npwp',
        'npwp',
        'npwp_nama',
        'npwp_alamat',
    ];

    public function pencairanSesi()
    {
        return $this->belongsTo('App\Models\DokumenPencairanSesi');
    }
}
