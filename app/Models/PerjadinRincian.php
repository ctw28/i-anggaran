<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjadinRincian extends Model
{
    use HasFactory;

    protected $fillable = [
        'pencairan_id',
        'perjadin_anggota_id',
        'tanggal_pergi',
        'tanggal_pulang',
        'uang_harian1',
        'uang_harian1_hari',
        'uang_harian2',
        'uang_harian2_hari',
        'penginapan1',
        'penginapan1_malam',
        'penginapan2',
        'penginapan2_malam',
        'representatif',
        'representatif_hari',
        'tiket_pulang',
        'tiket_pergi',
        'airport_tax_pergi',
        'airport_tax_pulang',
        'transport_kota_2',
        'transport2',
        'kantor_bst',
    ];

    public function pencairan()
    {
        return $this->belongsTo('App\Models\Pencairan');
    }
    public function anggota()
    {
        return $this->belongsTo('App\Models\PerjadinAnggota');
    }
}
