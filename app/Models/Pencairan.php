<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pencairan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kegiatan_id',
        'kode_akun_id',
        'pencairan_nama',
        'oleh',
    ];

    public function kegiatan()
    {
        return $this->belongsTo('App\Models\Kegiatan');
    }
    public function oleh()
    {
        return $this->belongsTo('App\Models\User', 'oleh');
    }
    public function detail()
    {
        return $this->hasOne('App\Models\PencairanDetail');
    }
    public function perjadin()
    {
        return $this->hasOne('App\Models\Perjadin');
    }
    public function kodeAkun()
    {
        return $this->belongsTo('App\Models\KodeAkun');
    }
    public function nominalPengaturan()
    {
        return $this->hasOne('App\Models\NominalPengaturan');
    }
    public function daftarNominal()
    {
        return $this->hasMany('App\Models\DaftarNominal');
    }
    public function belanjaBahan()
    {
        return $this->hasMany('App\Models\BelanjaBahan');
    }
    public function belanjaBahanPerusahaan()
    {
        return $this->hasOne('App\Models\BelanjaBahanPerusahaan');
    }

    public function usul()
    {
        return $this->hasOne('App\Models\PeriksaUsul');
    }
}
