<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaksanaanDasar extends Model
{
    use HasFactory;

    protected $fillable = [
        'dasar_jenis',
        'nomor',
        'kegiatan_id',
        'tanggal',
        'tentang',
        'path_file',
    ];

    public function kegiatan()
    {
        return $this->belongsTo('App\Models\Kegiatan');
    }
}
