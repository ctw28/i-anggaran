<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisasiRpd extends Model
{
    use HasFactory;

    protected $fillable = [
        "tahun_anggaran_id",
        "organisasi_id",
        "pagu_total",
    ];

    public function tahunAnggaran()
    {
        return $this->belongsTo("App\Models\TahunAnggaran");
    }
    public function organisasi()
    {
        return $this->belongsTo("App\Models\Organisasi");
    }
    public function kegiatan()
    {
        return $this->hasMany("App\Models\Kegiatan");
    }
    public function rencanaSesi()
    {
        return $this->hasMany("App\Models\RencanaSesi");
    }
}
