<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminOrganisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_role_id',
        'organisasi_id',
        'sebutan',
    ];

    public function userRole()
    {
        return $this->belongsTo('App\Models\UserRole');
    }
    public function organisasi()
    {
        return $this->belongsTo('App\Models\Organisasi');
    }
}
