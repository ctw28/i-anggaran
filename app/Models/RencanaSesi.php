<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaSesi extends Model
{
    use HasFactory;
    protected $fillable = [
        "organisasi_rpd_id",
        "is_rpd_kirim",
        "status",
    ];

    public function organisasiRpd()
    {
        return $this->belongsTo("App\Models\OrganisasiRpd");
    }
}
