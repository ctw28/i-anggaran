<?php

namespace App\Http\Controllers\SPI;

use App\Http\Controllers\Controller;
use App\Models\PeriksaList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PeriksaListController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function index(Request $request)
    {
        $tahunAnggaranId = $request->tahun_anggaran_id;
        $verifikatorId = $request->verifikator_id;
        $data = PeriksaList::with([
            'periksaUsul.pencairanSesi.kegiatan.organisasi.tahunAnggaran' => function ($tahunAnggaran) use ($tahunAnggaranId) {
                $tahunAnggaran->where('id', $tahunAnggaranId);
            },
            'periksaUsul.pencairanSesi.kegiatan.organisasi.organisasi',
        ])
            ->whereHas('periksaUsul.pencairanSesi.kegiatan.organisasi.tahunAnggaran', function ($tahunAnggaran) use ($tahunAnggaranId) {
                $tahunAnggaran->where('id', $tahunAnggaranId);
            })
            ->where('verifikator_id', $verifikatorId)
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

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'periksa_usul_id' => 'required|integer',
                'verifikator_id' => 'required|integer',
                'status' => 'required',
                'catatan' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                // return $validator->errors()->all();
                return response()->json([
                    'status' => false,
                    'message' => 'periksa inputan',
                    'details' => $validator->errors()->all(),
                ], 500);
            }
            // $check = PeriksaUsul::where('$request->dokumen_pencairan_sesi_id', '=', $request->$request->dokumen_pencairan_sesi_id)->first();
            $data = PeriksaSesi::updateOrCreate(
                ['id' => $request->id], // Kunci utama untuk mencari entri
                [
                    'periksa_usul_id' => $request->periksa_usul_id,
                    'verifikator_id' => $request->verifikator_id,
                    'status' => $request->status,
                    'catatan' => null,
                ]
            );
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $data,
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
}
