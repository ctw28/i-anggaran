<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelaksanaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'rencana_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'jumlah',
        'ppn',
        'pph',
    ];

    public function rencana()
    {
        return $this->belongsTo('App\Models\Rencana');
    }
    public function dasarPelaksanaan()
    {
        return $this->hasMany('App\Models\PelaksanaanDasar');
    }
    public function sesiPencairan()
    {
        return $this->hasMany('App\Models\DokumenPencairanSesi');
    }
    public function dokumen()
    {
        return $this->hasMany('App\Models\PelaksanaanDokumen');
    }
}
