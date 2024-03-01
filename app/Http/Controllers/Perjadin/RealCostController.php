<?php

namespace App\Http\Controllers\Perjadin;

use App\Http\Controllers\Controller;
use App\Models\PerjadinRealCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RealCostController extends Controller
{
    //



    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index($id)
    {
        $data = PerjadinRealCost::where('perjadin_anggota_id', $id)->get();
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
                'perjadin_anggota_id' => 'required|integer',
                'item' => 'required|string',
                'nilai' => 'required|numeric',
                'jenis' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                // return $validator->errors()->all();
                return response()->json([
                    'status' => false,
                    'message' => 'periksa inputan',
                    'details' => $validator->errors()->all(),
                ], 500);
            }
            $data = PerjadinRealCost::updateOrCreate(
                ['id' => $request->id], // Kunci utama untuk mencari entri
                [
                    'perjadin_anggota_id' => $request->perjadin_anggota_id,
                    'item' => $request->item,
                    'nilai' => $request->nilai,
                    'jenis' => 'transport'
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

    public function delete(Request $request)
    {
        $data = PerjadinRealCost::find($request->id);
        if (!$data)
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => $data,
            ], 200);
        $data->delete();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $data,
        ], 200);
    }
}
