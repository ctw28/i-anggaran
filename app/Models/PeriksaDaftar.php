<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaDaftar extends Model
{
    use HasFactory;

    protected $fillable = [
        'periksa_template_id',
        'periksa_kategori_id',
    ];
    public function periksaTemplate()
    {
        return $this->belongsTo('App\Models\PeriksaTemplate');
    }
    public function periksaKategori()
    {
        return $this->belongsTo('App\Models\PeriksaKategori');
    }
}
