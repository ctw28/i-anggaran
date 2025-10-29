<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BelanjaBahanPerusahaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pencairan_id',
        'is_ada_npwp',
        'npwp',
        'npwp_nama',
        'npwp_alamat',
    ];

    public function pencairan()
    {
        return $this->belongsTo('App\Models\Pencairan');
    }
}
