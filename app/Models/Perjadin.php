<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perjadin extends Model
{
    use HasFactory;

    protected $fillable = [
        'pencairan_id',
        'kota_tujuan',
        'tanggal_dokumen',
        'no_spd',
        'no_surat_tugas',
        'tanggal_surat_tugas',
        'tgl_mulai',
        'tgl_selesai',
    ];

    public function pencairan()
    {
        return $this->belongsTo('App\Models\Pencairan');
    }
    public function referensiUang()
    {
        return $this->hasMany('App\Models\PerjadinRefUang');
    }
    public function anggota()
    {
        return $this->hasMany('App\Models\PerjadinAnggota');
    }
    public function rincian()
    {
        return $this->hasOne('App\Models\PerjadinRincian');
    }
}
