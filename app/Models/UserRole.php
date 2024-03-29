<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
    public function adminOrganisasi()
    {
        return $this->hasOne('App\Models\AdminOrganisasi');
    }
    public function userOrganisasi()
    {
        return $this->hasOne('App\Models\UserOrganisasi');
    }
}
