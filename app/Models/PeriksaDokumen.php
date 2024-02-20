<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaDokumen extends Model
{
    use HasFactory;
    protected $fillable = [
        'periksa_sesi_id',
        'periksa_kategori_list_id',
        'is_valid',
        'catatan',
    ];

    public function periksaSesi()
    {
        return $this->belongsTo('App\Models\PeriksaSesi');
    }
    public function periksakategoriList()
    {
        return $this->belongsTo('App\Models\PeriksakategoriList');
    }
}
