<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarjasTemplateItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'berjas_template_bagian_id',
        'nama_dokumen',
        'urutan',
    ];

    public function templateBagian()
    {
        return $this->belongsTo('App\Models\BarjasTemplateBagian');
    }
    public function periksa()
    {
        return $this->hasOne('App\Models\BarjasSesiPeriksa');
    }
}
