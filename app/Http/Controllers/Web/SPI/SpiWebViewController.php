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

    public function cetak($periksaSesiId, $kategori)
    {
        $data['sesi_id'] = $periksaSesiId;
        if ($kategori == "lembar-periksa")
            return view('spi.cetak.lembar-periksa', $data);
        else if ($kategori == "berita-acara")
            return view('spi.cetak.berita-acara', $data);
    }
}
