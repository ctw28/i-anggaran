<?php

namespace App\Http\Controllers\SPI;

use App\Http\Controllers\Controller;
use App\Models\PeriksaPimpinan;
use App\Models\PeriksaSesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PeriksaPimpinanController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index(Request $request)
    {
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'periksa_sesi_id' => 'required|integer',
                'validasi_sekretaris' => 'boolean',
                'validasi_ketua' => 'boolean',
                'catatan_sekretaris' => 'nullable|string',
                'catatan_ketua' => 'nullable|string',
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
            $data = PeriksaPimpinan::updateOrCreate(
                ['id' => $request->id], // Kunci utama untuk mencari entri
                [
                    'periksa_sesi_id' => $request->periksa_sesi_id,
                    'validasi_sekretaris' => $request->validasi_sekretaris,
                    'validasi_ketua' => $request->validasi_ketua,
                    'catatan_sekretaris' => $request->catatan_sekretaris,
                    'catatan_ketua' => $request->catatan_ketua,
                ]
            );
            $sesi = PeriksaSesi::find($request->periksa_sesi_id);
            if ($request->validasi_sekretaris == 0)
                $sesi->status = "3";
            else if ($request->validasi_sekretaris == 2)
                $sesi->status = "0";
            $sesi->save();
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
