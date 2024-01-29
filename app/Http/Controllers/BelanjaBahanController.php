<?php

namespace App\Http\Controllers;

use App\Models\BelanjaBahan;
use App\Models\BelanjaBahanPerusahaan;
use App\Models\DokumenPencairanSesi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BelanjaBahanController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index($id)
    {
        Carbon::setLocale('id');

        $data = DokumenPencairanSesi::with(['kegiatan', 'pelaksanaanDasar', 'belanjaBahan' => function ($belanjaBahan) {
            $belanjaBahan->orderBy('urutan');
        }, 'kodeAkun', 'ppk.pegawai', 'bendahara.pegawai', 'belanjaBahanPerusahaan'])->where('id', $id)->get();
        foreach ($data as $item) {
            $date = Carbon::parse($item->tanggal_dokumen)->locale('id');

            $date->settings(['formatFunction' => 'translatedFormat']);

            $item->tanggal_dokumen_indonesia = $date->format('j F Y');

            $date = Carbon::parse($item->pelaksanaanDasar->tanggal)->locale('id');
            $date->settings(['formatFunction' => 'translatedFormat']);
            $item->pelaksanaanDasar->tanggal = $date->format('j F Y');
            // $total = 0;
            // $pajak = 0;
            // foreach ($item->belanjaBahan as $d) {
            //     $total = $total + $d->nilai;
            //     $pajak = $pajak + $d->pph;
            //     $pajak = $pajak + $d->pph;
            // }
            // $item->total = $total;
            // $item->pajak = $pajak;
            // $item->terima = $total - $pajak;
            // $item->terbilang = ucwords($this->terbilang($total));
            // $item->total = $total;
        }
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan ya',
            'data' => $data,
        ], 200);
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

    function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }

    public function store(Request $request)
    {
        // return $request->all();
        try {
            BelanjaBahan::where('dokumen_pencairan_sesi_id', $request->sesi_id)->delete();
            $data = BelanjaBahan::insert($request->data);

            // $data = DaftarNominal::insert([
            //     'dokumen_pencairan_sesi_id' => $request->dokumen_pencairan_sesi_id,
            //     'pegawai_nomor_induk' => $request->pegawai_nomor_induk,
            //     'nama' => $request->nama,
            //     'jabatan' => $request->jabatan,
            //     'golongan' => $request->golongan,
            //     'jumlah' => $request->jumlah,
            //     'honor' => $request->honor,
            //     'satuan' => $request->satuan,
            //     'total' => $request->total,
            //     'pph' => $request->pph,
            //     'diterima' => $request->diterima,
            //     'no_rek' => $request->no_rek,
            //     'bank' => $request->bank,
            // ]);
            return response()->json([
                'status' => true,
                'message' => 'Sukses insert',
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            // return response()->json([
            //     'status' => false,
            //     'message' => 'gagal update',
            //     'data' => [],
            // ], 500);
            throw $th;
        }
    }

    public function npwpUpdate(Request $request)
    {
        try {
            $data = BelanjaBahanPerusahaan::where('dokumen_pencairan_sesi_id', $request->sesi_id)->update(
                [
                    'is_ada_npwp' => $request->is_ada_npwp,
                    'npwp' => $request->npwp,
                    'npwp_nama' => $request->npwp_nama,
                    'npwp_alamat' => $request->npwp_alamat
                ]
            );

            return response()->json([
                'status' => true,
                'message' => 'Sukses update',
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            // return response()->json([
            //     'status' => false,
            //     'message' => 'gagal update',
            //     'data' => [],
            // ], 500);
            throw $th;
        }
    }
}
