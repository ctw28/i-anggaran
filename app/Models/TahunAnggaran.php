<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAnggaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'satker_id',
        'tahun',
        'sebutan',
    ];

    public function satker()
    {
        return $this->belongsTo('App\Models\Satker');
    }
    public function bendahara()
    {
        return $this->hasOne('App\Models\TahunAnggaranBendahara');
    }
    public function dipa()
    {
        return $this->hasOne('App\Models\TahunAnggaranDipa');
    }
}
