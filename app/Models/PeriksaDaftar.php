<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaDaftar extends Model
{
    use HasFactory;

    protected $fillable = [
        'periksa_daftar_template_id',
        'periksa_list_id',
    ];

    public function periksaTemplate()
    {
        return $this->belongsTo('App\Models\PeriksaTemplate');
    }
    public function periksaList()
    {
        return $this->belongsTo('App\Models\PeriksaList');
    }
}
