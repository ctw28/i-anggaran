<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAnggaranDipa extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_anggaran_id',
        'dipa_tgl',
        'dipa_nomor',
        'dipa_pagu',
    ];

    public function tahunAnggaran()
    {
        return $this->belongsTo('App\Models\TahunAnggaran');
    }
}
