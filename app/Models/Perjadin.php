<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perjadin extends Model
{
    use HasFactory;

    protected $fillable = [
        'kegiatan_id',
        'nama_perjadin',
        'kota_tujuan',
        'tanggal_dokumen',
        'no_surat_tugas',
        'tanggal_surat_tugas',
    ];

    public function kegiatan()
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
