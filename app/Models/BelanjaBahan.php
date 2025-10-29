<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BelanjaBahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pencairan_id',
        'item',
        'nilai',
        'ppn',
        'pph',
        'jenis',
        'urutan',
    ];

    public function pencairan()
    {
        return $this->belongsTo('App\Models\Pencairan');
    }
}
