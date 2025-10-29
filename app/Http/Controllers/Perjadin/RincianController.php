<?php

namespace App\Http\Controllers\Perjadin;

use App\Http\Controllers\Controller;
use App\Models\Perjadin;
use App\Models\PerjadinRincian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RincianController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index($anggotaId)
    {
        // $data = PerjadinRincian::where('perjadin_anggota_id', $id)->get();
        $data = PerjadinRincian::with(['pencairan.Perjadin', 'anggota' => function ($anggota) use ($anggotaId) {
            $anggota->where('id', $anggotaId)->with('rincian');
        }])
            ->whereHas('anggota', function ($anggota) use ($anggotaId) {
                $anggota->where('id', $anggotaId);
            })
            ->where('perjadin_anggota_id', $anggotaId)->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }
    public function store(Request $request)
    {
        // return $request->all();
        try {
            $validator = Validator::make($request->all(), [
                'pencairan_id' => 'required|integer',
                'perjadin_anggota_id' => 'required|integer',
                // 'nip' => 'nullable|string',
                // 'jabatan' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                // return $validator->errors()->all();
                return response()->json([
                    'status' => false,
                    'message' => 'periksa inputan',
                    'details' => $validator->errors()->all(),
                ], 500);
            }
            $data = PerjadinRincian::updateOrCreate(
                ['perjadin_anggota_id' => $request->perjadin_anggota_id], // Kunci utama untuk mencari entri
                [
                    'pencairan_id' => $request->pencairan_id,
                    'perjadin_anggota_id' => $request->perjadin_anggota_id,
                    'tanggal_pergi' => $request->tanggal_pergi,
                    'tanggal_pulang' => $request->tanggal_pulang,
                    'uang_harian1' => $request->uang_harian1,
                    'uang_harian1_hari' => $request->uang_harian1_hari,
                    'uang_harian2' => $request->uang_harian2,
                    'uang_harian2_hari' => $request->uang_harian2_hari,
                    'penginapan1' => $request->penginapan1,
                    'penginapan1_malam' => $request->penginapan1_malam,
                    'penginapan2' => $request->penginapan2,
                    'penginapan2_malam' => $request->penginapan2_malam,
                    'representatif' => $request->representatif,
                    'representatif_hari' => $request->representatif_hari,
                    'tiket_pulang' => $request->tiket_pulang,
                    'tiket_pergi' => $request->tiket_pergi,
                    'airport_tax_pergi' => $request->airport_tax_pergi,
                    'airport_tax_pulang' => $request->airport_tax_pulang,
                    'transport_kota_2' => $request->transport_kota_2,
                    'transport2' => $request->transport2,
                    'kantor_bst' => $request->kantor_bst,
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
