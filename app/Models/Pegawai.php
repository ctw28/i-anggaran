<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'idpeg',
        'pegawai_nomor_induk',
        'data_diri_id',
        'pegawai_kategori_id',
        'pegawai_jenis_id',
    ];

    public function dataDiri()
    {
        return $this->belongsTo('App\Models\DataDiri');
    }
    public function pegawaiKategori()
    {
        return $this->belongsTo('App\Models\PegawaiKategori');
    }
    public function pegawaiJenis()
    {
        return $this->belongsTo('App\Models\pegawaiJenis');
    }
}
