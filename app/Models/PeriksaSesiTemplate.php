<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaSesiTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'periksa_sesi_id',
        'periksa_template_id'
    ];

    public function periksaSesi()
    {
        return $this->belongsTo('App\Models\PeriksaSesi');
    }
    public function periksaTemplate()
    {
        return $this->belongsTo('App\Models\PeriksaTemplate');
    }
}
