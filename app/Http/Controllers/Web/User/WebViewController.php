<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebViewController extends Controller
{
    //
    public function login()
    {
        return view('login');
    }
    public function dashboard()
    {
        return view('user.dashboard');
    }
    public function pilihTahunAnggaran()
    {
        return view('user.pilih-tahun-anggaran');
    }
    public function kegiatan()
    {
        return view('user.kegiatan');
    }
    public function pelaksanaan()
    {
        return view('user.pelaksanaan');
    }
    public function pelaksanaanKelola($id)
    {
        $data['id'] = $id;
        return view('user.pelaksanaan-kelola', $data);
    }
    public function pencairan($id, $rencanaId)
    {
        $data['id'] = $id;
        $data['rencana_id'] = $rencanaId;
        return view('user.pencairan', $data);
    }

    public function cetak($sesiId, $kategori)
    {
        $data['sesi_id'] = $sesiId;
        if ($kategori == "daftar-nominal")
            return view('user.cetak.daftar-nominal', $data);
        else if ($kategori == "kwitansi")
            return view('user.cetak.kwitansi', $data);
        else if ($kategori == "rekap")
            return view('user.cetak.rekap', $data);
        else if ($kategori == "spm")
            return view('user.cetak.spm', $data);
        else if ($kategori == "sptjb")
            return view('user.cetak.sptjb', $data);
        else if ($kategori == "spi")
            return view('user.cetak.spi', $data);
    }
}
