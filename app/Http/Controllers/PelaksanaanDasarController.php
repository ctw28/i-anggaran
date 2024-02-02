<?php

namespace App\Http\Controllers;

use App\Models\PelaksanaanDasar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth; //use this library
use Carbon\Carbon;

class PelaksanaanDasarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function index($kegiatanId)
    {
        $data = PelaksanaanDasar::where('kegiatan_id', $kegiatanId)->get();
        Carbon::setLocale('id');
        foreach ($data as $dasar) {

            $dasar->tanggal_format = Carbon::parse($dasar->tanggal)->translatedFormat('d F Y');;
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
        ], 200);
    }

    public function create(Request $request)
    {
        //
    }


    public function store(Request $request)
    {
        //
        // return $request->all();
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'dasar_jenis' => 'required|string',
                'nomor' => 'required|string',
                'kegiatan_id' => 'required|integer',
                'tanggal' => 'required|date',
                'tentang' => 'required|string',
                'file' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            ]);

            if ($validator->fails()) {
                // return $validator->errors()->all();
                return response()->json([
                    'status' => false,
                    'message' => 'periksa inputan',
                    'details' => $validator->errors()->all(),
                ], 500);
            }
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                // Simpan file ke penyimpanan yang diinginkan (misalnya: folder 'uploads')
                $path = $file->store('uploads', 'public'); // Simpan file di storage/app/public/uploads
                // return $path;
                $kegiatan = PelaksanaanDasar::updateOrCreate(
                    ['id' => $request->id], // Kunci utama untuk mencari entri
                    [
                        'dasar_jenis' => $request->dasar_jenis,
                        'nomor' => $request->nomor,
                        'kegiatan_id' => $request->kegiatan_id,
                        'tanggal' => $request->tanggal,
                        'tentang' => $request->tentang,
                        'path_file' => $path,
                    ]
                );
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil ditambahkan',
                    'data' => $kegiatan,
                ], 200);
            }
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

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // Lakukan sesuatu dengan file, misalnya menyimpannya di storage atau folder yang diinginkan
            $file->store('folder_name'); // Contoh menyimpan file di dalam folder 'folder_name'

            return response()->json(['message' => 'File berhasil diunggah']);
        }

        return response()->json(['message' => 'Tidak ada file yang diunggah'], 400);
    }


    public function show($id)
    {
        //
    }


    public function delete($id)
    {
        //
        $data = PelaksanaanDasar::find($id);
        if ($data->count() > 0) {
            $data->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil dihapus',
                'data' => $data,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Data gagal dihapus',
            'data' => [],
        ], 404);
    }
}
