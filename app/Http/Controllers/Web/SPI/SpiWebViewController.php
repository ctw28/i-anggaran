<?php

namespace App\Http\Controllers\Web\SPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpiWebViewController extends Controller
{
    //
    public function dashboard()
    {
        return view('spi.dashboard');
    }
    public function usulan()
    {
        return view('spi.usulan');
    }
    public function periksaDokumen()
    {
        return view('spi.periksa-dokumen');
    }
}
