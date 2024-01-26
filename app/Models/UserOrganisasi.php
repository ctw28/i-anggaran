<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrganisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_role_id',
        'organisasi_id',
        'is_aktif',
    ];

    public function userRole()
    {
        return $this->belongsTo('App\Models\UserRole');
    }
    public function organisasi()
    {
        return $this->belongsTo('App\Models\Organisasi', 'organisasi_id');
    }
    // public function kegiatan()
    // {
    //     return $this->hasMany('App\Models\Kegiatan');
    // }
}
