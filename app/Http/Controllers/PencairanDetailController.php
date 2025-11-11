<?php

namespace App\Http\Controllers;

use App\Models\PencairanDasar;
use App\Models\PencairanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PencairanDetailController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index($id)
    {
        // return $id;
        $data = PencairanDetail::with(['ppk', 'bendahara', 'dasar'])
            ->where('pencairan_id', $id)
            ->first();
        // return $data;
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data,
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan',
            'data' => [],
        ], 200);
    }
    public function show($id)
    {
        $data = PencairanDetail::with(['ppk', 'bendahara'])
            ->where('pencairan_id', $id)
            ->get();
        if ($data->count() > 0)
            return response()->json([
                'status' => true,
                'message' => 'Data Pencairan ditemukan',
                'data' => $data,
            ], 200);

        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan',
            'data' => [],
        ], 404);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // $request->validate([
            //     'pencairan_id' => 'required|exists:pencairans,id',
            //     'nomor_sk' => 'required|string',
            //     'tanggal_sk' => 'required|date',
            //     'tanggal_dokumen' => 'required|date',
            //     'penerima_nama' => 'required|string',
            //     'penerima_jabatan' => 'required|string',
            //     'sptjb_nomor' => 'required|string',
            //     'sptjk_nama' => 'required|string',
            //     'sptjk_nip' => 'required|string',
            //     'sptjk_jabatan' => 'required|string',
            //     'ppk' => 'nullable|exists:organisasi_jabatan_sesis,id',
            //     'bendahara' => 'nullable|exists:organisasi_jabatan_sesis,id',
            // ]);

            $detail = PencairanDetail::updateOrCreate(
                ['pencairan_id' => $request->pencairan_id], // kondisi pencarian
                [
                    'nomor_sk' => $request->nomor_sk,
                    'tanggal_sk' => $request->tanggal_sk,
                    'tanggal_dokumen' => $request->tanggal_dokumen,
                    'tanggal_lunas' => $request->tanggal_lunas,
                    'penerima_nama' => $request->penerima_nama,
                    'penerima_2' => $request->penerima_2,
                    'penerima_jabatan' => $request->penerima_jabatan,
                    'penerima_nomor' => $request->penerima_nomor,
                    'kuitansi_nomor' => $request->kuitansi_nomor,
                    'sptjb_nomor' => $request->sptjb_nomor,
                    'sptjk_nama' => $request->sptjk_nama,
                    'sptjk_nip' => $request->sptjk_nip,
                    'sptjk_jabatan' => $request->sptjk_jabatan,
                    'ppk' => $request->ppk,
                    'bendahara' => $request->bendahara,
                ]
            );
            $dasar = PencairanDasar::updateOrCreate(
                ['pencairan_detail_id' => $detail->id], // kondisi pencarian
                [
                    'isKuitansi' => $request->dasar['isKuitansi'] ?? 0,
                    'isSK' => $request->dasar['isSK'] ?? 0,
                    'isSuratTugas' => $request->dasar['isSuratTugas'] ?? 0,
                ]
            );

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Detail pencairan berhasil disimpan!',
                'data' => $detail,
            ], 201);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan detail pencairan.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
