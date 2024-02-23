<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perjadin extends Model
{
    use HasFactory;

    protected $fillable = [
        'rencana_id',
        'nama_perjadin',
        'kota_tujuan',
        'tanggal_dokumen',
        'no_surat_tugas',
        'tanggal_surat_tugas',
    ];

    public function rencana()
    {
        return $this->belongsTo('App\Models\Kegiatan');
    }
    public function dinas()
    {
        return $this->hasMany('App\Models\PerjadinDinas');
    }
    public function anggota()
    {
        return $this->hasMany('App\Models\PerjadinDinasAnggota');
    }
}
