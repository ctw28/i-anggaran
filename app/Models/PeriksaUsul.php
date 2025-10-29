<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaUsul extends Model
{
    use HasFactory;

    protected $fillable = [
        'pencairan_id',
        'is_finish',
        'catatan',
    ];

    public function pencairan()
    {
        return $this->belongsTo('App\Models\Pencairan');
    }
    public function periksaSesi()
    {
        return $this->hasOne('App\Models\PeriksaSesi');
    }
}
