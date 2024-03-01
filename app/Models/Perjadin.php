<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perjadin extends Model
{
    use HasFactory;

    protected $fillable = [
        'rencana_id',
        'kegiatan_id',
        'nama_perjadin',
        'kota_tujuan',
        'tanggal_dokumen',
        'no_surat_tugas',
        'tanggal_surat_tugas',
        'tgl_mulai',
        'tgl_selesai',
    ];

    public function rencana()
    {
        return $this->belongsTo('App\Models\Rencana');
    }
    public function kegiatan()
    {
        return $this->belongsTo('App\Models\Kegiatan');
    }
    public function referensiUang()
    {
        return $this->hasMany('App\Models\PerjadinRefUang');
    }
    public function anggota()
    {
        return $this->hasMany('App\Models\PerjadinAnggota');
    }
    // public function rincian()
    // {
    //     return $this->hasOne('App\Models\PerjadinRincian');
    // }
}
