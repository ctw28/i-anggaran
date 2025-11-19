<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        "organisasi_rpd_id",
        "parent_id", //null jika merupakan kegiatan utama
        "kode_akun_id", //null jika merupakan kegiatan utama
        "sub_kegiatan_kode1", //null jika pecahan/detail dari kegiatan utama
        "sub_kegiatan_kode2", //null jika pecahan/detail dari kegiatan utama
        "sub_kegiatan_kode3", //null jika pecahan/detail dari kegiatan utama
        "sub_kegiatan_kode4", //null jika pecahan/detail dari kegiatan utama
        "sub_kegiatan_kode5", //null jika pecahan/detail dari kegiatan utama
        "kegiatan_nama",
        "volume", //null jika merupakan kegiatan utama
        "satuan", //null jika merupakan kegiatan utama
        "jumlah_biaya",
        "sumber_dana",
        "urutan",
    ];

    public function pencairan()
    {
        return $this->hasMany("App\Models\Pencairan");
    }
    public function organisasi()
    {
        return $this->belongsTo("App\Models\OrganisasiRpd", 'organisasi_rpd_id');
    }
    public function parent()
    {
        return $this->belongsTo("App\Models\Kegiatan");
    }
    public function kodeAkun()
    {
        return $this->belongsTo("App\Models\KodeAkun");
    }
    public function rencanaSesi()
    {
        return $this->hasMany("App\Models\RencanaSesi");
    }
    public function rencana()
    {
        return $this->hasMany("App\Models\Rpd");
    }
    public function laporan()
    {
        return $this->hasOne("App\Models\Rencana");
    }
}
