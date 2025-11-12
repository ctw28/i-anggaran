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
        'penerima_2',
        'penerima_nomor',
        'penerima_jabatan',
        'kuitansi_nomor',
        'sptjb_nomor',
        'sptjk_nama',
        'sptjk_nip',
        'sptjk_jabatan',
        'ppk_id',
        'bendahara_id',
    ];
    public function pencairan()
    {
        return $this->belongsTo('App\Models\Pencairan');
    }

    public function ppk()
    {
        return $this->belongsTo('App\Models\OrganisasiJabatanSesi', 'ppk_id');
    }
    public function bendahara()
    {
        return $this->belongsTo('App\Models\OrganisasiJabatanSesi', 'bendahara_id');
    }
    public function dasar()
    {
        return $this->hasOne('App\Models\PencairanDasar');
    }
}
