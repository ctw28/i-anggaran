<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencairanDasar extends Model
{
    use HasFactory;
    protected $fillable = [
        'pencairan_detail_id',
        'isKuitansi',
        'isSK',
        'isSuratTugas',
    ];

    public function pencairanDetail()
    {
        return $this->belongsTo('App\Models\PencairanDetail');
    }
}
