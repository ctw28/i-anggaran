<?php

namespace App\Http\Controllers;

use App\Models\RencanaSesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RencanaSesiController extends Controller
{
    //
    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'organisasi_rpd_id' => 'required|integer',
                'is_rpd_kirim' => 'boolean',
                'status' => 'boolean',

            ]);

            if ($validator->fails()) {
                // return $validator->errors()->all();
                return response()->json([
                    'status' => false,
                    'message' => 'periksa inputan',
                    'details' => $validator->errors()->all(),
                ], 500);
            }

            $data = RencanaSesi::insert([
                "organisasi_rpd_id" => $request->organisasi_rpd_id,
                "is_rpd_kirim" => 1,
                "status" => '0',
            ]);

            return response()->json([
                'status' => true,
                'message' => 'sukses',
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {

            throw $th;
            return;
            return response()->json([
                'status' => false,
                'message' => $th,
                'details' => [],
            ], 500);
        }
    }

    public function delete($kegiatanId)
    {
        // return $kegiatanId;
        $data = Kegiatan::find($kegiatanId);
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
}
