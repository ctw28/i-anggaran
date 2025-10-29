<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarjasSesiPeriksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'barjas_sesi_id',
        'barjas_template_item_id',
        'tanggal_dokumen',
    ];

    public function sesi()
    {
        return $this->belongsTo('App\Models\BerjasSesi');
    }
    public function templateItem()
    {
        return $this->belongsTo('App\Models\BerjasTemplateItem');
    }
}
