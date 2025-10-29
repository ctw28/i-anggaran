<?php

namespace App\Http\Controllers;

use App\Models\DaftarNominal;
use App\Models\DokumenPencairanSesi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DaftarNominalController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index($id)
    {
        Carbon::setLocale('id');
        $data = DaftarNominal::with('pencairan')->where('pencairan_id', $id)->orderBy('urutan')->get();

        if ($data->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => []
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            DaftarNominal::where('pencairan_id', $request->id)->delete();
            $data = DaftarNominal::insert($request->data);
            return response()->json([
                'status' => true,
                'message' => 'Sukses insert',
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'gagal update',
                'data' => $th,
            ], 500);
            throw $th;
        }
    }
}
