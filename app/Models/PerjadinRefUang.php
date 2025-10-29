<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjadinRefUang extends Model
{
    use HasFactory;
    protected $fillable = [
        'pencairan_id',
        'dinas_ke',
        'uang_harian',
        'uang_penginapan',
    ];

    public function pencairan()
    {
        return $this->belongsTo('App\Models\Pencairan');
    }
}
