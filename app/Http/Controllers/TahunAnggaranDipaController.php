<?php

namespace App\Http\Controllers;

use App\Models\TahunAnggaranDipa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth; //use this library
use Carbon\Carbon;
use DateTime;

class TahunAnggaranDipaController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    //

    public function index()
    {
        $data = TahunAnggaranDipa::where('tahun_anggaran_id', 1)->first();

        if ($data)
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
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
            $validator = Validator::make($request->all(), [
                'tahun_anggaran_id' => 'required|integer',
                'dipa_tgl' => 'required|date',
                'dipa_nomor' => 'required|string',
                'dipa_pagu' => 'nullable|integer',
            ]);

            if ($validator->fails()) {
                // return $validator->errors()->all();
                return response()->json([
                    'status' => false,
                    'message' => 'periksa inputan',
                    'details' => $validator->errors()->all(),
                ], 422);
            }

            $kegiatan = TahunAnggaranDipa::updateOrCreate(
                ['tahun_anggaran_id' => $request->tahun_anggaran_id], // Kunci utama untuk mencari entri
                [
                    'dipa_tgl' => $request->dipa_tgl,
                    'dipa_nomor' => $request->dipa_nomor,
                    'dipa_pagu' => $request->dipa_pagu,
                ]
            );
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $kegiatan,
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
