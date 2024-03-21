<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PeriksaDokumen;
use App\Models\PeriksaHistory;
use App\Models\PeriksaSesi;
use App\Models\PeriksaSesiTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function tracking(Request $request)
    {
        $tahunAnggaranId = $request->tahun_anggaran_id;
        $organisasiId = $request->organisasi_id;
        // return $organisasiId;
        $data = PeriksaSesi::with([
            'periksaUsul.pencairanSesi.kegiatan.organisasi.tahunAnggaran' => function ($tahunAnggaran) use ($tahunAnggaranId) {
                $tahunAnggaran->where('id', $tahunAnggaranId);
            },
            'periksaUsul.pencairanSesi.kegiatan.organisasi' => function ($organisasi) use ($organisasiId) {
                $organisasi->with('organisasi')->where('id', $organisasiId);
            },
        ])
            ->whereHas('periksaUsul.pencairanSesi.kegiatan.organisasi.tahunAnggaran', function ($tahunAnggaran) use ($tahunAnggaranId) {
                $tahunAnggaran->where('id', $tahunAnggaranId);
            })
            ->whereHas('periksaUsul.pencairanSesi.kegiatan.organisasi', function ($organisasi) use ($organisasiId) {
                $organisasi->where('id', $organisasiId)->with('organisasi');
            })
            ->get();

        if ($data->count() > 0)
            return response()->json([
                'status' => true,
                'message' => 'Data usulan ditemukan',
                'data' => $data,
            ], 200);
        return response()->json([
            'status' => false,
            'message' => 'Data usulan tidak ditemukan',
            'data' => [],
        ], 200);
    }
}
