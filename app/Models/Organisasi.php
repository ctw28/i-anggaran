<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'organisasi_grup_id',
        'organisasi_parent_id',
        'organisasi_nama',
        'organisasi_singkatan',
        'organisasi_keterangan',
        'is_current',
        'is_aktif',
    ];

    public function grup()
    {
        return $this->belongsTo('App\Models\OrganisasiGrup');
    }
    public function parent()
    {
        return $this->belongsTo('App\Models\Organisasi');
    }
    public function kegiatan()
    {
        return $this->hasMany('App\Models\Kegiatan');
    }
}
