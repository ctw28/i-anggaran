<?php

namespace App\Http\Controllers;

use App\Models\BelanjaBahanPerusahaan;
use App\Models\KodeAkun;
use App\Models\NominalPengaturan;
use App\Models\Pelaksanaan;
use App\Models\Pencairan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth; //use this library
use Carbon\Carbon;

class PencairanController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index($organiasiRpdId)
    {
        // return $organiasiRpdId;
        $data = Pencairan::with(['kodeAkun', 'usul', 'kegiatan'  => function ($kegiatan) use ($organiasiRpdId) {
            $kegiatan->where('organisasi_rpd_id', $organiasiRpdId);
        }])
            ->whereHas('kegiatan', function ($kegiatan) use ($organiasiRpdId) {
                $kegiatan->where('organisasi_rpd_id', $organiasiRpdId);
            })
            ->get();

        // return $data;
        if ($data->count() > 0) {
            return response()->json([
                'status' => true,
                'message' => 'Data rencana ditemukan',
                'data' => $data,
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan',
            'data' => [],
        ], 200);
    }
    public function show($id)
    {
        $data = Pencairan::with(['kegiatan', 'kodeAkun', 'detail', 'daftarNominal'])->find($id);

        if ($data->count() > 0)
            return response()->json([
                'status' => true,
                'message' => 'Data Pencairan ditemukan',
                'data' => $data,
            ], 200);

        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan',
            'data' => [],
        ], 404);
    }

    public function store(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $pencairan = Pencairan::create([
                'kegiatan_id' => $request->kegiatan_id,
                'kode_akun_id' => $request->kode_akun_id,
                'pencairan_nama' => $request->pencairan_nama,
                'oleh' => $user->id,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $pencairan,
            ], 200);
        } catch (\Throwable $th) {

            DB::rollback();
            throw $th;
            return;

            return response()->json([
                'status' => false,
                'message' => $th,
                'details' => [],
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'kegiatan_id' => 'required|exists:kegiatans,id',
                'kode_akun_id' => 'required|exists:kode_akuns,id',
                'pencairan_nama' => 'required|string|max:255',
            ]);

            $user = JWTAuth::parseToken()->authenticate();
            $pencairan = Pencairan::findOrFail($id);

            $pencairan->update([
                'kegiatan_id' => $request->kegiatan_id,
                'kode_akun_id' => $request->kode_akun_id,
                'pencairan_nama' => $request->pencairan_nama,
                'oleh' => $user->id,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diperbarui',
                'data' => $pencairan,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function delete($id)
    {
        // return $kegiatanId;
        $data = Pencairan::find($id);
        if ($data->count() > 0) {
            $data->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data,
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan',
            'data' => [],
        ], 404);
    }

    public function cetakNominal($id)
    {
        $data = Pencairan::with(['kegiatan', 'detail.ppk.pegawai', 'daftarNominal', 'detail.bendahara.pegawai', 'kodeAkun'])->where('id', $id)->first();
        // return $data->detail;
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data pencairan tidak ditemukan',
                'data' => null
            ], 404);
        }
        $date = Carbon::parse($data->detail->tanggal_dokumen)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $data->detail->tanggal_dokumen_indonesia = $date->format('j F Y');
        $date = Carbon::parse($data->detail->tanggal_sk)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $data->detail->tanggal_sk_indonesia = $date->format('j F Y');

        $total = 0;
        $pajak = 0;
        foreach ($data->daftarNominal as $d) {
            $total = $total + $d->total;
            $pajak = $pajak + $d->pph;
        }
        $data->total = $total;
        $data->pajak = $pajak;
        $data->terima = $total - $pajak;
        $data->terbilang = ucwords($this->terbilang($total));
        // $item->total = $total;

        return response()->json([
            'status' => true,
            'message' => 'Data pencairan ditemukan',
            'data' => $data
        ], 200);
    }

    public function cetakBelanja($id)
    {
        Carbon::setLocale('id');

        $data = Pencairan::with(['kegiatan', 'belanjaBahan' => function ($belanjaBahan) {
            $belanjaBahan->orderBy('urutan');
        }, 'kodeAkun', 'detail.ppk.pegawai', 'detail.bendahara.pegawai', 'detail.dasar', 'belanjaBahanPerusahaan'])->where('id', $id)->first();
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data pencairan tidak ditemukan',
                'data' => null
            ], 404);
        }
        $date = Carbon::parse($data->detail->tanggal_dokumen)->locale('id');

        $date->settings(['formatFunction' => 'translatedFormat']);

        $data->detail->tanggal_dokumen_indonesia = $date->format('j F Y');

        $total = 0;
        $pajak = 0;
        foreach ($data->belanjaBahan as $d) {
            $total = $total + $d->nilai;
            $pajak = $d->pph;
            $pajak = $pajak + $d->ppn;
        }
        $data->total = $total;
        $data->pajak = $pajak;
        $data->terima = $total - $pajak;
        $data->terbilang = ucwords($this->terbilang($total));
        $data->total = $total;

        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan ya',
            'data' => $data,
        ], 200);
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
