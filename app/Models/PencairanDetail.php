<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencairanDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'pencairan_id',
        'nomor_sk',
        'tanggal_sk',
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
        'ppk',
        'bendahara',
    ];
    public function pencairan()
    {
        return $this->belongsTo('App\Models\Pencairan');
    }

    public function ppk()
    {
        return $this->belongsTo('App\Models\OrganisasiJabatanSesi', 'ppk');
    }
    public function bendahara()
    {
        return $this->belongsTo('App\Models\OrganisasiJabatanSesi', 'bendahara');
    }
    public function dasar()
    {
        return $this->hasOne('App\Models\PencairanDasar');
    }
}
