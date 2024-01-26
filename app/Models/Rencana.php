<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rencana extends Model
{
    use HasFactory;

    protected $fillable = [
        'kegiatan_id',
        'tanggal_pencairan',
        'rencana_jumlah',
    ];

    public function kegiatan()
    {
        return $this->belongsTo('App\Models\Kegiatan');
    }
    public function pelaksanaan()
    {
        return $this->hasOne('App\Models\Pelaksanaan');
    }
}
