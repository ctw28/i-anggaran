<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Pencairan;
use App\Models\PerjadinAnggota;
use Carbon\Carbon;
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
        if ($jenis == "nominal") {

            $pencairan = Pencairan::with(['kegiatan', 'detail.dasar', 'detail.ppk.pegawai', 'daftarNominal', 'detail.bendahara.pegawai', 'kodeAkun'])->where('id', $pencairanId)->first();

            $date = Carbon::parse($pencairan->detail->tanggal_dokumen)->locale('id');
            $date->settings(['formatFunction' => 'translatedFormat']);
            $pencairan->detail->tanggal_dokumen_indonesia = $date->format('j F Y');
            $date = Carbon::parse($pencairan->detail->tanggal_sk)->locale('id');
            $date->settings(['formatFunction' => 'translatedFormat']);
            $pencairan->detail->tanggal_sk_indonesia = $date->format('j F Y');

            $total = 0;
            $pajak = 0;
            foreach ($pencairan->daftarNominal as $d) {
                $total = $total + $d->total;
                $pajak = $pajak + $d->pph;
            }
            $pencairan->total = $total;
            $pencairan->pajak = $pajak;
            $pencairan->terima = $total - $pajak;
            $pencairan->terbilang = ucwords($this->terbilang($total));
        } else {
            Carbon::setLocale('id');

            $pencairan = Pencairan::with(['kegiatan', 'belanjaBahan' => function ($belanjaBahan) {
                $belanjaBahan->orderBy('urutan');
            }, 'kodeAkun', 'detail.ppk.pegawai', 'detail.bendahara.pegawai', 'detail.dasar', 'belanjaBahanPerusahaan'])->where('id', $pencairanId)->first();
            if (!$pencairan) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data pencairan tidak ditemukan',
                    'data' => null
                ], 404);
            }
            $date = Carbon::parse($pencairan->detail->tanggal_dokumen)->locale('id');

            $date->settings(['formatFunction' => 'translatedFormat']);

            $pencairan->detail->tanggal_dokumen_indonesia = $date->format('j F Y');

            $date = Carbon::parse($pencairan->detail->tanggal_sk)->locale('id');
            $date->settings(['formatFunction' => 'translatedFormat']);
            $pencairan->detail->tanggal_sk_indonesia = $date->format('j F Y');

            $total = 0;
            $pajak = 0;
            foreach ($pencairan->belanjaBahan as $d) {
                $total = $total + $d->nilai;
                $pajak = $d->pph;
                $pajak = $pajak + $d->ppn;
            }
            $pencairan->total = $total;
            $pencairan->pajak = $pajak;
            $pencairan->terima = $total - $pajak;
            $pencairan->terbilang = ucwords($this->terbilang($total));
            $pencairan->total = $total;
        }


        $data['data'] = $pencairan;
        $data['pencairan_id'] = $pencairanId;
        $data['jenis'] = $jenis;
        // return $data;
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
        else if ($kategori == "ppspm")
            return view('user.cetak.ppspm', $data);
        else if ($kategori == "kuitansi-belanja-bahan")
            return view('user.cetak.belanja-bahan.kuitansi', $data);
        else if ($kategori == "rekap-belanja-bahan")
            return view('user.cetak.belanja-bahan.rekap', $data);
        else if ($kategori == "sptjb-belanja-bahan")
            return view('user.cetak.belanja-bahan.sptjb', $data);
        else if ($kategori == "spi-belanja-bahan")
            return view('user.cetak.belanja-bahan.spi', $data);
        else if ($kategori == "ppspm-belanja-bahan")
            return view('user.cetak.belanja-bahan.ppspm', $data);
        else if ($kategori == "spm-belanja-bahan")
            return view('user.cetak.belanja-bahan.spm', $data);
        else if ($kategori == "sptjk-belanja-bahan")
            return view('user.cetak.belanja-bahan.sptjk', $data);
    }

    public function cetakPerjadin($anggotaId, $kategori)
    {
        $data['data'] = PerjadinAnggota::with(['perjadin.pencairan', 'perjadin.rincian', 'realCost'])
            ->find($anggotaId);
        // return $data;

        if ($kategori == "checklist")
            return view('user.components.perjadin.cetak.checklist', $data);
        else if ($kategori == "real-cost")
            return view('user.perjadin.cetak.realcost', $data);
    }

    function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }
    public function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp =  $this->penyebut($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp =  $this->penyebut($nilai / 10) . " puluh" .  $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" .  $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp =  $this->penyebut($nilai / 100) . " ratus" .  $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" .  $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp =  $this->penyebut($nilai / 1000) . " ribu" .  $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp =  $this->penyebut($nilai / 1000000) . " juta" .  $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp =  $this->penyebut($nilai / 1000000000) . " milyar" .  $this->penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp =  $this->penyebut($nilai / 1000000000000) . " trilyun" .  $this->penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }
}
