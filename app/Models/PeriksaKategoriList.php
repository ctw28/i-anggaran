<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaKategoriList extends Model
{
    use HasFactory;

    protected $fillable = [
        'periksa_kategori_id',
        'periksa_list_id',
        'item',
        'urutan',
    ];

    public function periksaKategori()
    {
        return $this->belongsTo('App\Models\PeriksaKategori');
    }
    public function periksaList()
    {
        return $this->belongsTo('App\Models\PeriksaList');
    }
    public function periksaDokumen()
    {
        return $this->hasMany('App\Models\PeriksaDokumen');
    }
}
