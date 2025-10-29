<?php

namespace App\Http\Controllers;

use App\Models\BelanjaBahan;
use App\Models\BelanjaBahanPerusahaan;
use App\Models\DokumenPencairanSesi;
use App\Models\Pencairan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BelanjaBahanController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }


    public function index($id)
    {
        Carbon::setLocale('id');
        $data = BelanjaBahan::with('pencairan')->where('pencairan_id', $id)->orderBy('urutan')->get();

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
        // return $request->all();
        try {
            BelanjaBahan::where('pencairan_id', $request->id)->delete();
            $data = BelanjaBahan::insert($request->data);
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
    public function npwp($id)
    {
        Carbon::setLocale('id');
        $data = BelanjaBahanPerusahaan::where('pencairan_id', $id)->first();

        if (!$data) {
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

    public function npwpUpdate(Request $request)
    {
        // return $request->data['is_ada_npwp'];
        try {
            if ($request->data['is_ada_npwp'] == 0)
                $data = BelanjaBahanPerusahaan::where('pencairan_id', $request->data['pencairan_id'])->delete();
            else
                $data = BelanjaBahanPerusahaan::updateOrInsert(
                    ['pencairan_id' => $request->data['pencairan_id']], // Kondisi pencarian
                    [
                        'is_ada_npwp' => $request->data['is_ada_npwp'],
                        'npwp' => $request->data['npwp'],
                        'npwp_nama' => $request->data['npwp_nama'],
                        'npwp_alamat' => $request->data['npwp_alamat'],
                        'updated_at' => now()
                    ]
                );

            return response()->json([
                'status' => true,
                'message' => 'Sukses update',
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
