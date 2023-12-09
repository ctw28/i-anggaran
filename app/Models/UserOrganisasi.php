<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrganisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organisasi_id',
        'is_aktif',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function organisasi()
    {
        return $this->belongsTo('App\Models\Organisasi');
    }
    // public function kegiatan()
    // {
    //     return $this->hasMany('App\Models\Kegiatan');
    // }
}
