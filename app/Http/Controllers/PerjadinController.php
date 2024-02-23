<?php

namespace App\Http\Controllers;

use App\Models\Perjadin;
use App\Models\PerjadinDinas;
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

    public function index($id)
    {
        $data = Perjadin::where('rencana_id', $id)->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        // return $request->all();
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'rencana_id' => 'required|integer',
                'nama_perjadin' => 'required|string',
                'kota_tujuan' => 'required|string',
                'tanggal_dokumen' => 'required|date',
                'no_surat_tugas' => 'required|string',
                'tanggal_surat_tugas' => 'required|date',
                'dinas_ke' => 'string',
                'tgl_mulai' => 'nullable|date',
                'tgl_selesai' => 'nullable|date',
                'uang_harian' => 'nullable|numeric',
                'uang_penginapan' => 'nullable|numeric',
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
                ['id' => $request->id], // Kunci utama untuk mencari entri
                [
                    'rencana_id' => $request->rencana_id,
                    'nama_perjadin' => $request->nama_perjadin,
                    'kota_tujuan' => $request->kota_tujuan,
                    'tanggal_dokumen' => $request->tanggal_dokumen,
                    'no_surat_tugas' => $request->no_surat_tugas,
                    'tanggal_surat_tugas' => $request->tanggal_surat_tugas,
                ]
            );
            PerjadinDinas::where('perjadin_id', $data->id)->delete();
            $dinas = PerjadinDinas::insert([
                [
                    'perjadin_id' => $data->id,
                    'dinas_ke' => "1",
                    'tgl_mulai' => $request->tgl_mulai,
                    'tgl_selesai' => $request->tgl_selesai,
                    'uang_harian' => $request->uang_harian,
                    'uang_penginapan' => $request->uang_penginapan,
                ],
                [
                    'perjadin_id' => $data->id,
                    'dinas_ke' => "2",
                    'tgl_mulai' => $request->tgl_mulai2,
                    'tgl_selesai' => $request->tgl_selesai2,
                    'uang_harian' => $request->uang_harian2,
                    'uang_penginapan' => $request->uang_penginapan2,
                ],
            ]);
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $data->id,
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
