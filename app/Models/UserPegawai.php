<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pegawai_id',
        'is_aktif',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai');
    }
}
