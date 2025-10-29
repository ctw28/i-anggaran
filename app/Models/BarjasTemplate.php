<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarjasTemplate extends Model
{
    use HasFactory;


    protected $fillable = [
        'barjas_template_nama',
    ];

    public function bagian()
    {
        return $this->hasMany('App\Models\BarjasTemplateBagian');
    }
}
