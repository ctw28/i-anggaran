<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarjasTemplateBagian extends Model
{
    use HasFactory;

    protected $fillable = [
        'barjas_template_id',
        'nama_bagian',
        'urutan',
    ];

    public function template()
    {
        return $this->belongsTo('App\Models\BarjasTemplate');
    }
    public function item()
    {
        return $this->hasMany('App\Models\BarjasTemplateItem');
    }
}
