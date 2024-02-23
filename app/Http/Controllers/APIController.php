<?php

namespace App\Http\Controllers;

use App\Models\KodeAkun;
use App\Models\Organisasi;
use App\Models\OrganisasiJabatanSesi;
use App\Models\OrganisasiRpd;
use App\Models\TahunAnggaran;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth; //use this library

class APIController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function setOrganisasiSesi(Request $request)
    {
        // return "ggg";
        $token = JWTAuth::getToken();
        $payload = (object)JWTAuth::getPayload($token)->toArray();
        if ($payload->organisasi == "Admin SPI") {
            $data = ['id' => 0, 'role' => 'spi'];
        } else if ($payload->organisasi == "Administrator") {
            $data = ['id' => 0, 'role' => 'admin'];
        } else if ($payload->current_role == "verifikator_spi") {
            $data = ['id' => $payload->organisasi->id, 'role' => 'verifikator_spi'];
        } else {
            $data = OrganisasiRpd::where([
                'tahun_anggaran_id' => $request->tahun_anggaran_id,
                'organisasi_id' => $payload->organisasi->id,
            ])->first();
        }

        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }
    public function tahunAnggaran()
    {
        $data = TahunAnggaran::all();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }
    public function kodeAkun()
    {
        $data = KodeAkun::all();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }
    public function organisasi($kategori = NULL)
    {
        if ($kategori == NULL)
            $data = Organisasi::all();
        else if ($kategori == "no_parent")
            $data = Organisasi::where('organisasi_parent_id', NULL)->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }

    public function jabatan($flag)
    {
        // return $request->all();
        $data = OrganisasiJabatanSesi::with(['pegawai', 'organisasiJabatan' => function ($organisasiJabatan)  use ($flag) {
            $organisasiJabatan->where('jabatan_flag', $flag);
        }])
            ->whereHas('organisasiJabatan', function ($organisasiJabatan)  use ($flag) {
                $organisasiJabatan->where('jabatan_flag', $flag);
            })
            ->get();

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


    public function pejabat($organisasiId, $flag)
    {
        // return $request->all();
        $data = OrganisasiJabatanSesi::with(['pegawai', 'organisasiJabatan' => function ($organisasiJabatan)  use ($flag) {
            $organisasiJabatan->where('jabatan_flag', $flag);
        }])
            ->whereHas('organisasiJabatan', function ($organisasiJabatan)  use ($flag) {
                $organisasiJabatan->where('jabatan_flag', $flag);
            })
            ->where('organisasi_id', $organisasiId)->get();
        if ($data->isEmpty()) {
            $parentData = Organisasi::find($organisasiId);
            $data = OrganisasiJabatanSesi::with(['pegawai', 'organisasiJabatan' => function ($organisasiJabatan)  use ($flag) {
                $organisasiJabatan->where('jabatan_flag', $flag);
            }])
                ->whereHas('organisasiJabatan', function ($organisasiJabatan)  use ($flag) {
                    $organisasiJabatan->where('jabatan_flag', $flag);
                })
                ->where('organisasi_id', $parentData->organisasi_parent_id)->get();
        }
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
}
