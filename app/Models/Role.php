<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_nama',
        'role_keterangan',
    ];

    public function userRole()
    {
        return $this->hasOne('App\Models\UserRole');
    }
}
