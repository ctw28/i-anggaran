<?php

namespace App\Http\Controllers\SPI;

use App\Http\Controllers\Controller;
use App\Models\PeriksaSesi;
use App\Models\PeriksaUsul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PeriksaUsulController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index(Request $request)
    {
        $tahunAnggaranId = $request->tahun_anggaran_id;
        $data = PeriksaUsul::with([
            'pencairanSesi.kegiatan.organisasi.tahunAnggaran' => function ($tahunAnggaran) use ($tahunAnggaranId) {
                $tahunAnggaran->where('id', $tahunAnggaranId);
            },
            'pencairanSesi.kegiatan.organisasi.organisasi',
            'periksaSesi.verifikator.pegawai.dataDiri'
        ])
            ->whereHas('pencairanSesi.kegiatan.organisasi.tahunAnggaran', function ($tahunAnggaran) use ($tahunAnggaranId) {
                $tahunAnggaran->where('id', $tahunAnggaranId);
            })
            // ->whereDoesntHave('periksaSesi')
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
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        //
        // return $request->all();
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'dokumen_pencairan_sesi_id' => 'required|integer',
                'is_finish' => 'required|boolean',
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
            $check = PeriksaUsul::where('dokumen_pencairan_sesi_id', $request->dokumen_pencairan_sesi_id)->first();
            if ($check) {
                $data = PeriksaSesi::where('periksa_usul_id', $check->id)->first();
                if ($data) {
                    $data->status = "0";
                    $data->save();
                }
                // $data = PeriksaSesi::where('periksa_usul_id', $check->id);
                // $data->status = 0;
                // $data->save();
            } else {
                $data = PeriksaUsul::create(
                    [
                        'dokumen_pencairan_sesi_id' => $request->dokumen_pencairan_sesi_id,
                        'is_finish' => false,
                        'catatan' => null,
                    ]
                );
            }
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
