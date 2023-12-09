<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDiri extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'lahir_tempat',
        'lahir_tanggal',
        'no_hp',
        'alamat_ktp',
        'alamat_domisili',
    ];

    public function pegawai()
    {
        return $this->hasOne('App\Models\Pegawai');
    }
}
