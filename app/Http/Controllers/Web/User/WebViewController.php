<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\PerjadinAnggota;
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
        return view('pilih-tahun-anggaran');
    }
    public function kegiatan()
    {
        return view('user.kegiatan-data');
    }

    public function dokumenPencairan()
    {
        return view('user.dokumen-pencairan');
    }
    public function detail()
    {
        return view('user.dokumen-pencairan-detail');
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
    public function tracking()
    {
        return view('user.tracking');
    }

    public function cetak($pencairanId, $kategori, $jenis)
    {
        $data['pencairan_id'] = $pencairanId;
        $data['jenis'] = $jenis;
        if ($kategori == "ampra")
            return view('user.cetak.daftar-nominal', $data);
        else if ($kategori == "kuitansi")
            return view('user.cetak.kuitansi', $data);
        else if ($kategori == "rekap")
            return view('user.cetak.rekap', $data);
        else if ($kategori == "spm")
            return view('user.cetak.spm', $data);
        else if ($kategori == "sptjb")
            return view('user.cetak.sptjb', $data);
        else if ($kategori == "sptjk")
            return view('user.cetak.sptjk', $data);
        else if ($kategori == "spi")
            return view('user.cetak.spi', $data);
        else if ($kategori == "kuitansi2")
            return view('user.cetak.belanja-bahan.kuitansi2', $data);
        else if ($kategori == "rekap2")
            return view('user.cetak.belanja-bahan.rekap', $data);
        else if ($kategori == "sptjb2")
            return view('user.cetak.belanja-bahan.sptjb', $data);
        else if ($kategori == "spi-2")
            return view('user.cetak.belanja-bahan.spi', $data);
        else if ($kategori == "spm-2")
            return view('user.cetak.belanja-bahan.spm', $data);
        else if ($kategori == "sptjk-2")
            return view('user.cetak.belanja-bahan.sptjk', $data);
    }

    public function cetakPerjadin($anggotaId, $kategori)
    {
        $data['data'] = PerjadinAnggota::with(['pencairan.perjadin', 'rincian', 'realCost'])
            ->find($anggotaId);
        // return $data;

        if ($kategori == "checklist")
            return view('user.components.perjadin.cetak.checklist', $data);
        else if ($kategori == "real-cost")
            return view('user.perjadin.cetak.realcost', $data);
    }
}
