<?php

namespace App\Http\Controllers\Perjadin;

use App\Http\Controllers\Controller;
use App\Models\PerjadinAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnggotaController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index($id)
    {
        $data = PerjadinAnggota::where('pencairan_id', $id)->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }
    public function show($id)
    {
        $data = PerjadinAnggota::with(['rincian', 'pencairan'])->find($id);
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'pencairan_id' => 'required|integer',
                'nama' => 'required|string',
                'nip' => 'nullable|string',
                'jabatan' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                // return $validator->errors()->all();
                return response()->json([
                    'status' => false,
                    'message' => 'periksa inputan',
                    'details' => $validator->errors()->all(),
                ], 500);
            }
            $data = PerjadinAnggota::create(
                [
                    'pencairan_id' => $request->pencairan_id,
                    'nama' => $request->nama,
                    'nip' => $request->nip,
                    'jabatan' => $request->jabatan
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
