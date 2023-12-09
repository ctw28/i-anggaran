<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_anggaran_id',
        'organisasi_id',
        'parent_id',
        'kode_akun_id',
        'sub_kegiatan_kode1',
        'sub_kegiatan_kode2',
        'sub_kegiatan_kode3',
        'sub_kegiatan_kode4',
        'sub_kegiatan_kode5',
        'kegiatan_nama',
        'volume',
        'satuan',
        'jumlah_biaya',
        'sumber_dana',
    ];

    public function tahunAnggaran()
    {
        return $this->belongsTo('App\Models\TahunAnggaran');
    }
}
