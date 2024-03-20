<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaSesi extends Model
{
    use HasFactory;

    protected $fillable = [
        'periksa_usul_id',
        'verifikator_id',
        'status',
        'catatan',
        'sumber_dana',
    ];

    public function periksaDokumen()
    {
        return $this->hasMany('App\Models\PeriksaDokumen');
    }
    public function periksaSesiTemplate()
    {
        return $this->hasOne('App\Models\PeriksaSesiTemplate');
    }
    public function periksaUsul()
    {
        return $this->belongsTo('App\Models\PeriksaUsul');
    }
    public function verifikator()
    {
        return $this->belongsTo('App\Models\Verifikator');
    }
    public function periksaLembar()
    {
        return $this->hasMany('App\Models\PeriksaLembar');
    }
    public function periksaPimpinan()
    {
        return $this->hasOne('App\Models\PeriksaPimpinan');
    }
    public function periksaHistory()
    {
        return $this->hasOne('App\Models\PeriksaHistory');
    }
}
