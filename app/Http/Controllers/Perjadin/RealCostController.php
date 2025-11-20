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
                'items' => 'required|array',
                'items.*.item' => 'required|string',
                'items.*.nilai' => 'required|numeric',
                'items.*.jenis' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Periksa inputan',
                    'details' => $validator->errors()->all(),
                ], 422);
            }

            $anggotaId = $request->perjadin_anggota_id;
            $items = $request->items;

            // 🚀 HAPUS semua data lama milik anggota ini (replace all)
            PerjadinRealCost::where('perjadin_anggota_id', $anggotaId)->delete();

            $saved = [];

            foreach ($items as $row) {
                $saved[] = PerjadinRealCost::create([
                    'perjadin_anggota_id' => $anggotaId,
                    'item' => $row['item'],
                    'nilai' => $row['nilai'],
                    'jenis' => $row['jenis'] ?? 'transport',
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data Real Cost berhasil disimpan',
                'data' => $saved,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
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
