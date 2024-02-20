<?php

namespace App\Http\Controllers\SPI;

use App\Http\Controllers\Controller;
use App\Models\PeriksaDokumen;
use App\Models\PeriksaSesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PeriksaDokumenController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function index()
    {
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'periksa_sesi_id' => 'required|integer',
                'periksa_kategori_list_id' => 'required|integer',
                'is_valid' => 'required|boolean',
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
            $data = PeriksaDokumen::updateOrCreate(
                ['id' => $request->id], // Kunci utama untuk mencari entri
                [
                    'periksa_sesi_id' => $request->periksa_sesi_id,
                    'periksa_kategori_list_id' => $request->periksa_kategori_list_id,
                    'is_valid' => $request->is_valid,
                    'catatan' => $request->catatan,
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

    public function delete($id)
    {
        // return $kegiatanId;
        $data = PeriksaDokumen::find($id);
        if ($data->count() > 0) {
            $data->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data dihapus',
                'data' => $data,
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan',
            'data' => [],
        ], 404);
    }

    public function history(Request $request)
    {
        $sesiId = $request->periksa_sesi_id;
        $data = PeriksaDokumen::where('periksa_sesi_id', $sesiId);
        foreach ($data as $row) {
            if ($row->is_valid == 0) {
                PeriksaHistory::create([
                    'periksa_sesi_id' => $sesiId,
                    'catatan' => $row->catatan,
                ]);
            }
        }
    }
}
