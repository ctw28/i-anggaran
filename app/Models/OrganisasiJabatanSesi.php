<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisasiJabatanSesi extends Model
{
    use HasFactory;

    protected $fillable = [
        "tahun_anggaran_id",
        "organisasi_id",
        "organisasi_jabatan_id",
        "jabatan_parent_sesi",
        "pegawai_id",
        "nama_pejabat",
        "jabatan_sesi_nama",
        "jabatan_sesi_singkatan",
        "jabatan_urutan",
        "jabatan_keterangan",
        "is_aktif",
    ];

    public function tahunAnggaran()
    {
        return $this->belongsTo("App\Models\TahunAnggaran");
    }
    public function organisasi()
    {
        return $this->belongsTo("App\Models\Organisasi");
    }
    public function organisasiJabatan()
    {
        return $this->belongsTo("App\Models\OrganisasiJabatan");
    }
    public function parent()
    {
        return $this->belongsTo("App\Models\OrganisasiJabatanSesi");
    }
    public function pegawai()
    {
        return $this->belongsTo("App\Models\Pegawai");
    }
}
