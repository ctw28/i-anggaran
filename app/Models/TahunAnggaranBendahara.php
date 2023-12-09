<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAnggaranBendahara extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_anggaran_id',
        'pegawai_id',
        'bendahara_nama',
        'is_aktif',
    ];

    public function tahunAnggaran()
    {
        return $this->belongsTo('App\Models\TahunAnggaran');
    }
    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai');
    }
}
