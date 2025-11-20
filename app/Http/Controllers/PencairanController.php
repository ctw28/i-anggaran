<?php

namespace App\Http\Controllers;

use App\Models\BelanjaBahanPerusahaan;
use App\Models\Kegiatan;
use App\Models\KodeAkun;
use App\Models\NominalPengaturan;
use App\Models\Pelaksanaan;
use App\Models\Pencairan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth; //use this library
use Carbon\Carbon;

class PencairanController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index($organiasiRpdId)
    {
        $perPage = request()->get('per_page', 10);
        $kegiatanId = request()->get('kegiatan_id'); // ambil kegiatan_id jika ada

        $query = Pencairan::with([
            'kodeAkun',
            'usul',
            'kegiatan' => function ($k) use ($organiasiRpdId) {
                $k->where('organisasi_rpd_id', $organiasiRpdId);
            }
        ]);

        // Jika filter kegiatan_id dikirim, pakai where kegiatan langsung
        if ($kegiatanId) {
            $query->where('kegiatan_id', $kegiatanId);
        } else {
            // default: filter organisasi
            $query->whereHas('kegiatan', function ($k) use ($organiasiRpdId) {
                $k->where('organisasi_rpd_id', $organiasiRpdId);
            });
        }

        $query->orderBy('id', 'desc');

        $data = $query->paginate($perPage);

        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ]);
    }
    public function summary()
    {
        $kegiatanId = request()->get('kegiatan_id');
        $status = request()->get('status');

        // 🔹 Ambil pagu
        $kegiatan = Kegiatan::select('jumlah_biaya')
            ->find($kegiatanId);

        // 🔹 1) QUERY LIST SESUAI FILTER STATUS (untuk tabel)
        $pencairanList = Pencairan::with(['kodeAkun', 'usul'])
            ->where('kegiatan_id', $kegiatanId)
            ->when($status !== 'semua', function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->get();

        // 🔹 2) QUERY UNTUK PERHITUNGAN REALISASI (SELALU STATUS = selesai)
        $pencairanRealisasi = Pencairan::with(['kodeAkun'])
            ->where('kegiatan_id', $kegiatanId)
            ->where('status', 'selesai')
            ->get();

        $items = [];
        $totalSemuaCair = 0;

        // 🔹 Perhitungan realisasi hanya dari 'selesai'
        foreach ($pencairanRealisasi as $p) {

            $totalCair = 0;

            // 1️⃣ HONOR
            if ($p->daftarNominal()->exists()) {
                $totalCair = $p->daftarNominal()->sum('total');
            }

            // 2️⃣ BELANJA BAHAN
            else if ($p->belanjaBahan()->exists()) {
                $totalCair = $p->belanjaBahan()->sum('nilai');
            }

            // 3️⃣ PERJADIN
            else if ($p->perjadin()->exists()) {

                $perjadin = $p->perjadin;

                foreach ($perjadin->anggota as $anggota) {

                    // skip jika belum punya rincian
                    if (!$anggota->rincian) continue;

                    $r = $anggota->rincian;

                    $totalCair +=
                        ($r->uang_harian1 * $r->uang_harian1_hari) +
                        ($r->uang_harian2 * $r->uang_harian2_hari) +
                        ($r->penginapan1 * $r->penginapan1_malam) +
                        ($r->penginapan2 * $r->penginapan2_malam) +
                        $r->representatif +
                        $r->tiket_pulang +
                        $r->tiket_pergi +
                        $r->airport_tax_pergi +
                        $r->airport_tax_pulang +
                        $r->transport_kota_2 +
                        $r->transport2 +
                        $r->kantor_bst;
                }
            }

            $totalSemuaCair += $totalCair;
        }

        // 🔹 Bangun list untuk tabel (ikut filter status)
        // Build list untuk tampilan tabel
        foreach ($pencairanList as $p) {

            // 👍 total pencairan apa pun statusnya
            $totalPerPencairan = $this->hitungTotalPencairan($p);

            $items[] = [
                'id' => $p->id,
                'pencairan_nama' => $p->pencairan_nama,
                'kode_akun' => $p->kodeAkun,
                'status' => $p->status,
                'total_cair' => $totalPerPencairan
            ];
        }

        $countDraft = Pencairan::where('kegiatan_id', $kegiatanId)
            ->where('status', 'draft')
            ->count();

        $countProses = Pencairan::where('kegiatan_id', $kegiatanId)
            ->where('status', 'proses')
            ->count();

        $countSelesai = Pencairan::where('kegiatan_id', $kegiatanId)
            ->where('status', 'selesai')
            ->count();

        return response()->json([
            'status' => true,
            'pagu' => $kegiatan->jumlah_biaya ?? 0,
            'total_cair' => $totalSemuaCair,
            'sisa' => ($kegiatan->jumlah_biaya ?? 0) - $totalSemuaCair,
            'count_draft' => $countDraft,
            'count_proses' => $countProses,
            'count_selesai' => $countSelesai,
            'data' => $items
        ]);
    }

    private function hitungTotalPencairan(Pencairan $p)
    {
        $total = 0;

        // HONOR
        if ($p->daftarNominal()->exists()) {
            return $p->daftarNominal()->sum('total');
        }

        // BELANJA BAHAN
        if ($p->belanjaBahan()->exists()) {
            return $p->belanjaBahan()->sum('nilai');
        }

        // PERJADIN
        if ($p->perjadin()->exists()) {
            $perjadin = $p->perjadin;

            foreach ($perjadin->anggota as $anggota) {

                if (!$anggota->rincian) continue;

                $r = $anggota->rincian;

                $total +=
                    ($r->uang_harian1 * $r->uang_harian1_hari) +
                    ($r->uang_harian2 * $r->uang_harian2_hari) +
                    ($r->penginapan1 * $r->penginapan1_malam) +
                    ($r->penginapan2 * $r->penginapan2_malam) +
                    $r->representatif +
                    $r->tiket_pulang +
                    $r->tiket_pergi +
                    $r->airport_tax_pergi +
                    $r->airport_tax_pulang +
                    $r->transport_kota_2 +
                    $r->transport2 +
                    $r->kantor_bst;
            }
        }

        return $total;
    }

    public function show($id)
    {
        $data = Pencairan::with(['kegiatan', 'kodeAkun', 'detail', 'daftarNominal'])->find($id);

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
            $user = JWTAuth::parseToken()->authenticate();
            $pencairan = Pencairan::create([
                'kegiatan_id' => $request->kegiatan_id,
                'kode_akun_id' => $request->kode_akun_id,
                'pencairan_nama' => $request->pencairan_nama,
                'oleh' => $user->id,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $pencairan,
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

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'kegiatan_id' => 'required|exists:kegiatans,id',
                'kode_akun_id' => 'required|exists:kode_akuns,id',
                'pencairan_nama' => 'required|string|max:255',
            ]);

            $user = JWTAuth::parseToken()->authenticate();
            $pencairan = Pencairan::findOrFail($id);

            $pencairan->update([
                'kegiatan_id' => $request->kegiatan_id,
                'kode_akun_id' => $request->kode_akun_id,
                'pencairan_nama' => $request->pencairan_nama,
                'oleh' => $user->id,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diperbarui',
                'data' => $pencairan,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function delete($id)
    {
        // return $kegiatanId;
        $data = Pencairan::find($id);
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

    public function cetakNominal($id)
    {
        $data = Pencairan::with(['kegiatan', 'detail.dasar', 'detail.ppk.pegawai', 'daftarNominal', 'detail.bendahara.pegawai', 'kodeAkun'])->where('id', $id)->first();
        // return $data->detail;
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data pencairan tidak ditemukan',
                'data' => null
            ], 404);
        }
        $date = Carbon::parse($data->detail->tanggal_dokumen)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $data->detail->tanggal_dokumen_indonesia = $date->format('j F Y');
        $date = Carbon::parse($data->detail->tanggal_sk)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $data->detail->tanggal_sk_indonesia = $date->format('j F Y');

        $total = 0;
        $pajak = 0;
        foreach ($data->daftarNominal as $d) {
            $total = $total + $d->total;
            $pajak = $pajak + $d->pph;
        }
        $data->total = $total;
        $data->pajak = $pajak;
        $data->terima = $total - $pajak;
        $data->terbilang = ucwords($this->terbilang($total));
        // $item->total = $total;

        return response()->json([
            'status' => true,
            'message' => 'Data pencairan ditemukan',
            'data' => $data
        ], 200);
    }

    public function cetakBelanja($id)
    {
        Carbon::setLocale('id');

        $data = Pencairan::with(['kegiatan', 'belanjaBahan' => function ($belanjaBahan) {
            $belanjaBahan->orderBy('urutan');
        }, 'kodeAkun', 'detail.ppk.pegawai', 'detail.bendahara.pegawai', 'detail.dasar', 'belanjaBahanPerusahaan'])->where('id', $id)->first();
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data pencairan tidak ditemukan',
                'data' => null
            ], 404);
        }
        $date = Carbon::parse($data->detail->tanggal_dokumen)->locale('id');

        $date->settings(['formatFunction' => 'translatedFormat']);

        $data->detail->tanggal_dokumen_indonesia = $date->format('j F Y');

        $date = Carbon::parse($data->detail->tanggal_sk)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $data->detail->tanggal_sk_indonesia = $date->format('j F Y');

        $total = 0;
        $pajak = 0;
        foreach ($data->belanjaBahan as $d) {
            $total = $total + $d->nilai;
            $pajak = $d->pph;
            $pajak = $pajak + $d->ppn;
        }
        $data->total = $total;
        $data->pajak = $pajak;
        $data->terima = $total - $pajak;
        $data->terbilang = ucwords($this->terbilang($total));
        $data->total = $total;

        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan ya',
            'data' => $data,
        ], 200);
    }
    function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }
    public function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp =  $this->penyebut($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp =  $this->penyebut($nilai / 10) . " puluh" .  $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" .  $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp =  $this->penyebut($nilai / 100) . " ratus" .  $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" .  $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp =  $this->penyebut($nilai / 1000) . " ribu" .  $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp =  $this->penyebut($nilai / 1000000) . " juta" .  $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp =  $this->penyebut($nilai / 1000000000) . " milyar" .  $this->penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp =  $this->penyebut($nilai / 1000000000000) . " trilyun" .  $this->penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }
}
