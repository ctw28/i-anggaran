<?php

namespace App\Http\Controllers\SPI;

use App\Http\Controllers\Controller;
use App\Models\PeriksaDokumen;
use App\Models\PeriksaHistory;
use App\Models\PeriksaSesi;
use App\Models\PeriksaSesiTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PeriksaSesiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index(Request $request)
    {
        $tahunAnggaranId = $request->tahun_anggaran_id;
        $verifikatorId = $request->verifikator_id;
        $data = PeriksaSesi::with([
            'periksaUsul.pencairanSesi.kegiatan.organisasi.tahunAnggaran' => function ($tahunAnggaran) use ($tahunAnggaranId) {
                $tahunAnggaran->where('id', $tahunAnggaranId);
            },
            'periksaUsul.pencairanSesi.kegiatan.organisasi.organisasi',
            'periksaPimpinan'
        ])
            ->whereHas('periksaUsul.pencairanSesi.kegiatan.organisasi.tahunAnggaran', function ($tahunAnggaran) use ($tahunAnggaranId) {
                $tahunAnggaran->where('id', $tahunAnggaranId);
            })
            ->where('verifikator_id', $verifikatorId)
            ->get();

        if ($data->count() > 0)
            return response()->json([
                'status' => true,
                'message' => 'Data usulan ditemukan',
                'data' => $data,
            ], 200);
        return response()->json([
            'status' => false,
            'message' => 'Data usulan tidak ditemukan',
            'data' => [],
        ], 200);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'periksa_usul_id' => 'required|integer',
                'verifikator_id' => 'required|integer',
                'status' => 'required',
                'catatan' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                // return $validator->errors()->all();
                return response()->json([
                    'status' => false,
                    'message' => 'periksa inputan',
                    'details' => $validator->errors()->all(),
                ], 500);
            }
            // $check = PeriksaUsul::where('$request->dokumen_pencairan_sesi_id', '=', $request->$request->dokumen_pencairan_sesi_id)->first();
            $data = PeriksaSesi::updateOrCreate(
                ['id' => $request->id], // Kunci utama untuk mencari entri
                [
                    'periksa_usul_id' => $request->periksa_usul_id,
                    'verifikator_id' => $request->verifikator_id,
                    'status' => $request->status,
                    'catatan' => null,
                ]
            );
            if ($request->status == 0) {
                PeriksaSesiTemplate::create([
                    'periksa_sesi_id' => $data->id,
                    'periksa_template_id' => 1
                ]);
            }
            if ($request->status == 1) {
                $sesiId = $request->id;
                $data = PeriksaDokumen::where('periksa_sesi_id', $sesiId);
                foreach ($data as $row) {
                    if ($row->is_valid == 0) {
                        PeriksaHistory::create([
                            'periksa_sesi_id' => $sesiId,
                            'catatan' => $row->catatan,
                        ]);
                    }
                }
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $data,
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
    public function update($id, Request $request)
    {
        DB::beginTransaction();

        // return $request->all();
        try {
            // $data = json_decode($request->data, true);
            // return $data;
            // $check = PeriksaUsul::where('$request->dokumen_pencairan_sesi_id', '=', $request->$request->dokumen_pencairan_sesi_id)->first();
            $sesi = PeriksaSesi::find($id);
            // $sesi->update($data);
            $sesi->status = $request->status;
            $sesi->save();
            // return $update;
            if ($request->status == 1) {
                // $sesiId = $request->id;
                $periksaDokumen = PeriksaDokumen::where('periksa_sesi_id', $id)->get();
                // return $periksaDokumen;
                foreach ($periksaDokumen as $row) {
                    if ($row->is_valid == 0) {
                        PeriksaHistory::create([
                            'periksa_sesi_id' => $id,
                            // 'periksa_dokumen_id' => $row->id,
                            'catatan' => $row->catatan,
                        ]);
                    }
                }
            }
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Data update',
                'data' => $sesi,
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
}
