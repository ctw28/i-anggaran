<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminViewController extends Controller
{
    //
    public function rpd()
    {
        return view('admin.rpd');
    }
    public function tahunAnggaran()
    {
        return view('admin.tahun-anggaran-setting');
    }
}
