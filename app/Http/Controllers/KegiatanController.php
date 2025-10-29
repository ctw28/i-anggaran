<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Organisasi;
use App\Models\OrganisasiRpd;
use App\Models\Rencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth; //use this library
use Carbon\Carbon;
use Illuminate\Support\Str;
// use Maatwebsite\Excel\Facades\Excel;

class KegiatanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        Carbon::setLocale('id');
    }

    public function index(Request $request)
    {
        $data = Kegiatan::where('organisasi_rpd_id', $request->id)->get();

        return response()->json([
            'status' => $data->isNotEmpty(),
            'message' => $data->isNotEmpty() ? 'Data ditemukan' : 'Data tidak ditemukan',
            'data' => $data->isNotEmpty() ? $data : null,
        ], 200);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $check = OrganisasiRpd::with(['kegiatan' => function ($kegiatan) use ($request) {
            $kegiatan->where('sub_kegiatan_kode1', $request->sub_kegiatan_kode1)
                ->where('sub_kegiatan_kode2', $request->sub_kegiatan_kode2)
                ->where('sub_kegiatan_kode3', $request->sub_kegiatan_kode3)
                ->where('sub_kegiatan_kode4', $request->sub_kegiatan_kode4)
                ->where('sub_kegiatan_kode5', $request->sub_kegiatan_kode5);
        }])
            ->find($request->organisasi_rpd_id);
        // return $check;
        if ($check->kegiatan->count() != 0) {
            if (!$request->has('id')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data sub kegiatan sudah ada, periksa kode sub kegiatan',
                    'data' => $check,
                ], 422);
            }
        }
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'organisasi_rpd_id' => 'required|integer',
                'parent_id' => 'nullable|integer',
                'kode_akun_id' => 'nullable|integer',
                'sub_kegiatan_kode1' => 'nullable|string',
                'sub_kegiatan_kode2' => 'nullable|string',
                'sub_kegiatan_kode3' => 'nullable|string',
                'sub_kegiatan_kode4' => 'nullable|string',
                'sub_kegiatan_kode5' => 'nullable|string',
                'kegiatan_nama' => 'required|string',
                'volume' => 'nullable|integer',
                'satuan' => 'nullable|integer',
                'jumlah_biaya' => 'required|numeric',
                'sumber_dana' => 'required|string',
                'urutan' => 'required|integer'
            ], [
                'kegiatan_nama.required' => 'Nama kegiatan wajib diisi.',
                'jumlah_biaya.required' => 'Jumlah biaya tidak boleh kosong.',
                'jumlah_biaya.numeric' => 'Jumlah biaya harus berupa angka.',
                'jumlah_biaya.min' => 'Jumlah biaya tidak boleh negatif.',
            ]);

            if ($validator->fails()) {
                // return $validator->errors()->all();
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->all(),
                ], 422);
            }

            $kegiatan = Kegiatan::updateOrCreate(
                ['id' => $request->id], // Kunci utama untuk mencari entri
                [
                    'organisasi_rpd_id' => $request->organisasi_rpd_id,
                    'parent_id' => $request->parent_id, //null jika merupakan kegiatan utama
                    'kode_akun_id' => $request->kode_akun_id, //null jika merupakan kegiatan utama
                    'sub_kegiatan_kode1' => $request->sub_kegiatan_kode1, //null jika pecahan/detail dari kegiatan utama
                    'sub_kegiatan_kode2' => $request->sub_kegiatan_kode2, //null jika pecahan/detail dari kegiatan utama
                    'sub_kegiatan_kode3' => $request->sub_kegiatan_kode3, //null jika pecahan/detail dari kegiatan utama
                    'sub_kegiatan_kode4' => $request->sub_kegiatan_kode4, //null jika pecahan/detail dari kegiatan utama
                    'sub_kegiatan_kode5' => $request->sub_kegiatan_kode5, //null jika pecahan/detail dari kegiatan utama
                    'kegiatan_nama' => $request->kegiatan_nama,
                    'volume' => $request->volume, //null jika merupakan kegiatan utama
                    'satuan' => $request->satuan, //null jika merupakan kegiatan utama
                    'jumlah_biaya' => $request->jumlah_biaya,
                    'sumber_dana' => $request->sumber_dana,
                    'urutan' => $request->urutan,
                ]
            );
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $kegiatan,
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

    public function show($kegiatanId)
    {
        // return $kegiatanId;
        $data = Kegiatan::with(['rencana.pelaksanaan.sesiPencairan.kodeAkun'])->find($kegiatanId);

        $arrayBaru = []; // Buat array baru untuk menyimpan data baru

        foreach ($data->rencana as $index => $rencana) {
            if ($rencana->tanggal_pencairan) {
                $tanggal = Carbon::createFromFormat('Y-m-d', $rencana->tanggal_pencairan)->day;
                $bulan = Carbon::createFromFormat('Y-m-d', $rencana->tanggal_pencairan)->month;
                $formattedNumber = number_format($rencana->rencana_jumlah, 0, ',', '.'); // Mengubah 1000 menjadi 1.000

                $arrayBaru[$index]['id'] = $rencana->id;
                $arrayBaru[$index]['tanggal'] = $tanggal;
                $arrayBaru[$index]['bulan'] = $bulan;
                $arrayBaru[$index]['bulan_indonesia'] = Str::ucfirst(Carbon::createFromFormat('m', $bulan)->translatedFormat('F'));
                $arrayBaru[$index]['jumlah'] = $formattedNumber;
                $arrayBaru[$index]['rencana_jumlah'] = $rencana->rencana_jumlah;
                $arrayBaru[$index]['pelaksanaan'] = $rencana->pelaksanaan;
            }
        }
        unset($data['rencana']);
        $data['rencana'] = $arrayBaru;
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

    public function delete($kegiatanId)
    {
        // return $kegiatanId;
        $data = Kegiatan::find($kegiatanId);
        if ($data->count() > 0) {
            $data->delete();
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
        ], 404);
    }

    public function rpdstore(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'kegiatan_id' => 'required|integer',
                    'tanggal_pencairan' => 'required|date',
                    'rencana_jumlah' => 'required|numeric',
                ],
                [
                    'tanggal_pencairan.required' => 'Tanggal Rencana Pencairan harus diisi ',
                    'rencana_jumlah.required' => 'Jumlah Pencairan harus diisi ',
                    'rencana_jumlah.numeric' => 'Jumlah Pencairan harus angka ',
                ]
            );

            if ($validator->fails()) {
                // return $validator->errors()->all();
                return response()->json([
                    'status' => false,
                    'message' => 'periksa inputan',
                    'details' => $validator->errors()->all(),
                ], 422);
            }

            $rencana = Rencana::updateOrCreate(
                ['id' => $request->id], // Kunci utama untuk mencari entri
                [
                    'kegiatan_id' => $request->kegiatan_id,
                    'tanggal_pencairan' => $request->tanggal_pencairan,
                    'rencana_jumlah' => $request->rencana_jumlah,
                ]
            );
            $rencana->tanggal = Carbon::createFromFormat('Y-m-d', $rencana->tanggal_pencairan)->day;
            $bulan = Carbon::createFromFormat('Y-m-d', $rencana->tanggal_pencairan)->month;

            $rencana->bulan_indonesia = Str::ucfirst(Carbon::createFromFormat('m', $bulan)->translatedFormat('F'));
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $rencana,
            ], 200);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'status' => false,
                'message' => 'Data gagal ditambahkan',
                'data' => [],
            ], 500);
        }
    }

    public function rpdShow($rpdId)
    {
        // return $kegiatanId;
        $data = Rencana::find($rpdId);

        Carbon::setLocale('id');
        if ($data->tanggal_pencairan) {
            $tanggal = Carbon::createFromFormat('Y-m-d', $data->tanggal_pencairan)->day;
            $bulan = Carbon::createFromFormat('Y-m-d', $data->tanggal_pencairan)->month;
            $formattedNumber = number_format($data->rencana_jumlah, 0, ',', '.'); // Mengubah 1000 menjadi 1.000
            $arrayBaru['bulan_indonesia'] = Str::ucfirst(Carbon::createFromFormat('m', $bulan)->translatedFormat('F'));

            $arrayBaru['id'] = $data->id;
            $arrayBaru['tanggal'] = $tanggal;
            $arrayBaru['jumlah'] = $formattedNumber;
            $arrayBaru['rencana_jumlah'] = $data->rencana_jumlah;
        }


        if ($data->count() > 0)
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $arrayBaru,
            ], 200);
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan',
            'data' => [],
        ], 404);
    }

    public function rpdDelete($rpdId)
    {
        // return $kegiatanId;
        $data = Rencana::find($rpdId);
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

    //ADMIN

    public function organisasiRpd()
    {
        $data = OrganisasiRpd::with(['rencanaSesi', 'organisasi'])->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }

    public function adminKegiatan(Request $request)
    {
        $data = OrganisasiRpd::with('kegiatan.rencana')->find($request->organisasi_rpd_id);
        if ($data->kegiatan->count() > 0) {
            foreach ($data->kegiatan as $index => $kegiatan) {
                $arrayBaru = []; // Buat array baru untuk menyimpan data baru

                foreach ($kegiatan->rencana as $rencana) {
                    if ($rencana->tanggal_pencairan) {
                        $tanggal = Carbon::createFromFormat('Y-m-d', $rencana->tanggal_pencairan)->day;
                        $bulan = Carbon::createFromFormat('Y-m-d', $rencana->tanggal_pencairan)->month;
                        $formattedNumber = number_format($rencana->rencana_jumlah, 0, ',', '.'); // Mengubah 1000 menjadi 1.000
                        Carbon::setLocale('id');

                        $arrayBaru[$bulan]['bulan_indonesia'] = Str::ucfirst(Carbon::createFromFormat('m', $bulan)->translatedFormat('F'));

                        $arrayBaru[$bulan]['id'] = $rencana->id;
                        $arrayBaru[$bulan]['tanggal'] = $tanggal;
                        $arrayBaru[$bulan]['bulan'] = $bulan;
                        $arrayBaru[$bulan]['jumlah'] = $formattedNumber;
                    }
                }

                // Menambahkan array baru ke dalam variabel $kegiatan
                unset($data->kegiatan[$index]['rencana']);
                $data->kegiatan[$index]['rencana'] = $arrayBaru;
            }
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
        ], 404);
    }
}
