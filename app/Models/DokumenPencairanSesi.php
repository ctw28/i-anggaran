<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPencairanSesi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kegiatan_id',
        'pelaksanaan_id',
        'kode_akun_id',
        'ppk',
        'bendahara',
        'pelaksanaan_dasar_id',
        'pencairan_nama',
        'tanggal_dokumen',
        'tanggal_lunas',
        'penerima_nama',
        'penerima_nomor',
        'penerima_jabatan',
        'kuitansi_nomor',
        'sptjb_nomor',
        'sptjk_nama',
        'sptjk_nip',
        'sptjk_jabatan',
        'is_selesai',
    ];

    public function kegiatan()
    {
        return $this->belongsTo('App\Models\Kegiatan');
    }
    public function pelaksanaan()
    {
        return $this->belongsTo('App\Models\Pelaksanaan');
    }
    public function kodeAkun()
    {
        return $this->belongsTo('App\Models\KodeAkun');
    }
    public function pelaksanaanDasar()
    {
        return $this->belongsTo('App\Models\PelaksanaanDasar');
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
    public function ppk()
    {
        return $this->belongsTo('App\Models\OrganisasiJabatanSesi', 'ppk');
    }
    public function bendahara()
    {
        return $this->belongsTo('App\Models\OrganisasiJabatanSesi', 'bendahara');
    }

    public function usul()
    {
        return $this->hasOne('App\Models\PeriksaUsul');
    }
}
