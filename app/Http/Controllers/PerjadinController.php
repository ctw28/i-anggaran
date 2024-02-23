<?php

namespace App\Http\Controllers;

use App\Models\Perjadin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PerjadinController extends Controller
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
        // return $request->all();
        try {
            $validator = Validator::make($request->all(), [
                'kegiatan_id' => 'required|integer',
                'nama_perjadin' => 'required|string',
                'kota_tujuan' => 'required|string',
                'tanggal_dokumen' => 'required|date',
                'no_surat_tugas' => 'required|string',
                'tanggal_surat_tugas' => 'required|date',
            ]);

            if ($validator->fails()) {
                // return $validator->errors()->all();
                return response()->json([
                    'status' => false,
                    'message' => 'periksa inputan',
                    'details' => $validator->errors()->all(),
                ], 500);
            }
            $data = Perjadin::updateOrCreate(
                ['id' => $request->pelaksanaan_id], // Kunci utama untuk mencari entri
                [
                    'kegiatan_id' => $request->kegiatan_id,
                    'nama_perjadin' => $request->nama_perjadin,
                    'kota_tujuan' => $request->kota_tujuan,
                    'tanggal_dokumen' => $request->tanggal_dokumen,
                    'no_surat_tugas' => $request->no_surat_tugas,
                    'tanggal_surat_tugas' => $request->tanggal_surat_tugas,
                ]
            );
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
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
}
