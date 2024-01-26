<?php

namespace App\Http\Controllers;

use App\Models\DokumenPencairanSesi;
use App\Models\NominalPengaturan;
use App\Models\Pelaksanaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth; //use this library
use Carbon\Carbon;

class PencairanSesiController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index($rencanaId)
    {
        // return $rencanaId;
        $data = DokumenPencairanSesi::with(['pelaksanaanDasar', 'nominalPengaturan', 'kodeAkun', 'pelaksanaan' => function ($pelaksanaan) use ($rencanaId) {
            $pelaksanaan->where('rencana_id', $rencanaId);
        }])->get();
        Carbon::setLocale('id');
        foreach ($data as $dasar) {
            $dasar->pelaksanaanDasar->tanggal_format = Carbon::parse($dasar->pelaksanaanDasar->tanggal)->translatedFormat('d F Y');;
        }
        if ($data->count() > 0)
            return response()->json([
                'status' => true,
                'message' => 'Data rencana ditemukan',
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

        // return $request->all();
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'kegiatan_id' => 'required|integer',
                'rencana_id' => 'required|integer',
                'kode_akun_id' => 'required|integer',
                'ppk' => 'required|integer',
                'bendahara' => 'required|integer',
                'pelaksanaan_dasar_id' => 'required|integer',
                'pencairan_nama' => 'required|string',
                'tanggal_dokumen' => 'required|date',
                'penerima_nama' => 'required|string',
                'penerima_nomor' => 'nullable|string',
                'penerima_jabatan' => 'required|string',
                'kuitansi_nomor' => 'required|string',
                'sptjb_nomor' => 'required|string',
                'sptjk_nama' => 'required|string',
                'sptjk_nip' => 'required|string',
                'sptjk_jabatan' => 'required|string',
            ]);

            if ($validator->fails()) {
                // return $validator->errors()->all();
                return response()->json([
                    'status' => false,
                    'message' => 'periksa inputan',
                    'details' => $validator->errors()->all(),
                ], 500);
            }
            $pelaksanaan = Pelaksanaan::updateOrCreate(
                ['id' => $request->pelaksanaan_id], // Kunci utama untuk mencari entri
                [
                    'rencana_id' => $request->rencana_id,
                    'tanggal_mulai' => $request->tanggal_mulai,
                    'tanggal_selesai' => $request->tanggal_selesai,
                ]
            );

            $pencairanSesi = DokumenPencairanSesi::updateOrCreate(
                ['id' => $request->id], // Kunci utama untuk mencari entri
                [
                    'kegiatan_id' => $request->kegiatan_id,
                    'pelaksanaan_id' => $pelaksanaan->id,
                    'kode_akun_id' => $request->kode_akun_id,
                    'ppk' => $request->ppk,
                    'bendahara' => $request->bendahara,
                    'pelaksanaan_dasar_id' => $request->pelaksanaan_dasar_id,
                    'tanggal_dokumen' => $request->tanggal_dokumen,
                    'pencairan_nama' => $request->pencairan_nama,
                    'tanggal_lunas' => $request->tanggal_dokumen,
                    'penerima_nama' => $request->penerima_nama,
                    'penerima_nomor' => $request->penerima_nomor,
                    'penerima_jabatan' => $request->penerima_jabatan,
                    'kuitansi_nomor' => $request->kuitansi_nomor,
                    'sptjb_nomor' => $request->sptjb_nomor,
                    'sptjk_nama' => $request->sptjk_nama,
                    'sptjk_nip' => $request->sptjk_nip,
                    'sptjk_jabatan' => $request->sptjk_jabatan,
                    'is_selesai' => false,
                ]
            );

            NominalPengaturan::create([
                'dokumen_pencairan_sesi_id' => $pencairanSesi->id,
                'is_peserta_luar' => false,
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $pencairanSesi,
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
