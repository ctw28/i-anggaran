<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_satker',
        'nama_satker',
        'alamat',
        'is_current',
    ];

    public function npwp()
    {
        return $this->hasOne('App\Models\SatkerNpwp');
    }
}
