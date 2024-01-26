<?php

namespace App\Http\Controllers;

use App\Models\TahunAnggaranSesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth; //use this library
use Carbon\Carbon;
use DateTime;

class TahunAnggaranSesiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    //

    public function index()
    {
        $data = TahunAnggaranSesi::where('tahun_anggaran_id', 1)->first();
        Carbon::setLocale('id');

        $mulai = $data->tanggal_rpd_mulai;
        $selesai = $data->tanggal_rpd_selesai;

        $data->tanggal_mulai = $data->tanggal_rpd_mulai;
        $data->tanggal_selesai = $data->tanggal_rpd_selesai;
        // Mengonversi string tanggal menjadi objek DateTime
        $tanggalMulai = new DateTime($mulai);
        $tanggalSelesai = new DateTime($selesai);
        $tanggalSekarang = new DateTime(); // Tanggal saat ini
        $tanggalMulaiIndo = Carbon::parse($mulai)->translatedFormat('j F Y');
        $tanggalSelesaiIndo = Carbon::parse($selesai)->translatedFormat('j F Y');
        $data->tanggal_rpd_mulai = $tanggalMulaiIndo;
        $data->tanggal_rpd_selesai = $tanggalSelesaiIndo;
        // $test = [
        //     'tanggal_mulai' => $tanggalMulai,
        //     'tanggal_selesai' => $tanggalSelesai,
        //     'tanggal_sekarang' => $tanggalSekarang,
        // ]
        // Mengecek apakah tanggal saat ini berada di antara tanggal mulai dan tanggal selesai
        if ($tanggalSekarang >= $tanggalMulai && $tanggalSekarang <= $tanggalSelesai) {
            // Jika tanggal saat ini berada di antara rentang tanggal
            $data->is_open = true;
        } else {
            $data->is_open = false;
        }

        if ($data->count() > 0)
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
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
            $validator = Validator::make($request->all(), [
                'tahun_anggaran_id' => 'required|integer',
                'tanggal_rpd_mulai' => 'required|date',
                'tanggal_rpd_selesai' => 'required|date|after_or_equal:tanggal_rpd_mulai',
                'catatan' => 'nullable|string',
            ], [
                'tanggal_rpd_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
            ]);

            if ($validator->fails()) {
                // return $validator->errors()->all();
                return response()->json([
                    'status' => false,
                    'message' => 'periksa inputan',
                    'details' => $validator->errors()->all(),
                ], 422);
            }

            $kegiatan = TahunAnggaranSesi::updateOrCreate(
                ['tahun_anggaran_id' => $request->tahun_anggaran_id], // Kunci utama untuk mencari entri
                [
                    'tanggal_rpd_mulai' => $request->tanggal_rpd_mulai,
                    'tanggal_rpd_selesai' => $request->tanggal_rpd_selesai,
                    'catatan' => $request->catatan,
                ]
            );
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $kegiatan,
            ], 200);
        } catch (\Throwable $th) {

            // throw $th;
            // return;

            return response()->json([
                'status' => false,
                'message' => $th,
                'details' => [],
            ], 500);
        }
    }
}
