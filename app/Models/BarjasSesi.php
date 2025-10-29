<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarjasSesi extends Model
{
    use HasFactory;

    protected $fillable = [
        'verifikator_id',
        'barjas_template_id',
        'satker',
        'barjas_nama',
        'ppk',
        'pejabat_pengadaan',
        'rekanan',
        'metode',
        'tanggal_kontrak',
        'nilai',
        'kode_akun',
        'tanggal_periksa',
    ];

    public function verifikator()
    {
        return $this->belongsTo('App\Models\Verifikator');
    }
    public function barjasTemplate()
    {
        return $this->belongsTo('App\Models\BarjasTemplate');
    }
    public function sesiPeriksa()
    {
        return $this->hasMany('App\Models\BarjasSesiPeriksa');
    }
}
