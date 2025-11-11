<?php

namespace App\Http\Controllers;

use App\Models\Perjadin;
use App\Models\PerjadinRefUang;
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
        $data = Perjadin::with('referensiUang')->where('pencairan_id', $id)->first();

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null,
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }
    public function show($id)
    {
        $data = Perjadin::with('referensiUang')->where('id', $id)->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        return $request->data;
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'pencairan_id' => 'required|integer',
                'kota_tujuan' => 'required|string',
                'tanggal_dokumen' => 'required|date',
                'no_surat_tugas' => 'required|string',
                'tanggal_surat_tugas' => 'required|date',
                'dinas_ke' => 'string',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date',
                'uang_harian1' => 'required|numeric',
                'uang_penginapan1' => 'required|numeric',
                'uang_harian2' => 'nullable|numeric',
                'uang_penginapan2' => 'nullable|numeric',
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
                ['pencairan_id' => $request->pencairan_id], // Kunci utama untuk mencari entri
                [
                    'pencairan_id' => $request->pencairan_id,
                    'kota_tujuan' => $request->kota_tujuan,
                    'tanggal_dokumen' => $request->tanggal_dokumen,
                    'no_surat_tugas' => $request->no_surat_tugas,
                    'tanggal_surat_tugas' => $request->tanggal_surat_tugas,
                    'tgl_mulai' => $request->tgl_mulai,
                    'tgl_selesai' => $request->tgl_selesai,
                ]
            );
            PerjadinRefUang::where('perjadin_id', $data->id)->delete();
            $dinas = PerjadinRefUang::insert([
                [
                    'perjadin_id' => $data->id,
                    'dinas_ke' => "1",
                    'uang_harian' => $request->uang_harian1,
                    'uang_penginapan' => $request->uang_penginapan1,
                ],
                [
                    'perjadin_id' => $data->id,
                    'dinas_ke' => "2",
                    'uang_harian' => $request->uang_harian2,
                    'uang_penginapan' => $request->uang_penginapan2,
                ],
            ]);
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

    public function delete($id)
    {
        $data = Perjadin::find($id);
        if ($data->count() > 0) {
            $data->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data dihapus ditemukan',
                'data' => $data,
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan',
            'data' => [],
        ], 404);
    }
}
