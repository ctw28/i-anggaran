<?php

namespace App\Http\Controllers;

use App\Models\NominalPengaturan;
use Illuminate\Http\Request;

class NominalPengaturanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index($id)
    {
        $data = NominalPengaturan::where('dokumen_pencairan_sesi_id', $id)->first();
        if ($data === null) {
            $data = NominalPengaturan::create([
                'dokumen_pencairan_sesi_id' => $id,
                'is_peserta_luar' => false,
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            //code...
            $data = NominalPengaturan::where('dokumen_pencairan_sesi_id', $id)->first();

            if ($data) {
                $data->is_peserta_luar = $request->is_peserta_luar;
                $data->save();

                // ...
                return response()->json([
                    'status' => true,
                    'message' => 'Sukses update',
                    'data' => $data,
                ], 200);
            }
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
