<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth; //use this library
use Carbon\Carbon;

class PelaksanaanController extends Controller
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
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'rencana_id' => 'required|integer',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date',
                'jumlah' => 'nullable|float',
                'ppn' => 'nullable|float',
                'pph' => 'nullable|float',
            ]);

            if ($validator->fails()) {
                // return $validator->errors()->all();
                return response()->json([
                    'status' => false,
                    'message' => 'periksa inputan',
                    'details' => $validator->errors()->all(),
                ], 500);
            }

            $kegiatan = Pelaksanaan::updateOrCreate(
                ['id' => $request->id], // Kunci utama untuk mencari entri
                [
                    'rencana_id' => $request->rencana_id,
                    'tanggal_mulai' => $request->tanggal_mulai,
                    'tanggal_selesai' => $request->tanggal_selesai,
                ]
            );

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $kegiatan,
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
    public function show($id)
    {
    }
}
