<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeAkun extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama_akun',
        'keterangan',
        'jenis_kuitansi',
        'is_pajak',
    ];

    public function dataDiri()
    {
        return $this->belongsTo('App\Models\DataDiri');
    }
}
