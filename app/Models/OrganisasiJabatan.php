<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisasiJabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        "jabatan_nama",
        "jabatan_singkatan",
        "jabatan_untuk",
        "jabatan_flag",
        "jabatan_keterangan"
    ];

    public function jabatanSesi()
    {
        return $this->hasMany("App\Models\OrganisasiJabatanSesi");
    }
}
