<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAnggaranSesi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_anggaran_id',
        'tanggal_rpd_mulai',
        'tanggal_rpd_selesai',
        'catatan',
    ];

    public function tahunAnggaran()
    {
        return $this->belongsTo('App\Models\TahunAnggaran');
    }
}
