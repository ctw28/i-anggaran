<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarNominal extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokumen_pencairan_sesi_id',
        'pegawai_nomor_induk',
        'nama',
        'jabatan',
        'golongan',
        'jumlah',
        'honor',
        'satuan',
        'total',
        'pph',
        'diterima',
        'no_rek',
        'bank',
        'urutan',
    ];

    public function pencairanSesi()
    {
        return $this->belongsTo('App\Models\DokumenPencairanSesi');
    }
}
