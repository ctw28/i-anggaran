<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatkerNpwp extends Model
{
    use HasFactory;

    protected $fillable = [
        'satker_id',
        'npwp_nomor',
        'npwp_alamat',
    ];

    public function satker()
    {
        return $this->belongsTo('App\Models\Satker');
    }
}
