<?php

namespace App\Http\Controllers\SPI;

use App\Http\Controllers\Controller;
use App\Models\BarjasSesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BarjasSesiController extends Controller
{
    //
    public function index(Request $request)
    {
        // return $request->all();
        $query = BarjasSesi::query();

        if ($request->has('verifikator_id')) {
            $query->where('verifikator_id', $request->verifikator_id);
            return response()->json([
                'status' => true,
                'message' => 'Data usulan ditemukan',
                'data' => $query->get()
            ], 200);
        }
        if ($request->has('sesi_id')) {
            $sesiId = $request->sesi_id;
            if ($request->has('template')) {
                $query->with(['barjasTemplate.bagian.item.periksa' => function ($periksa) use ($sesiId) {
                    $periksa->where('barjas_sesi_id', $sesiId);
                }]);
            }
            if ($request->has('verifikator')) {
                $query->with(['verifikator.pegawai.dataDiri']);
            }
            return response()->json([
                'status' => true,
                'message' => 'Data usulan ditemukan',
                'data' => $query->find($request->sesi_id)
            ], 200);
        }


        return response()->json([
            'status' => false,
            'message' => 'Data usulan tidak ditemukan',
            'data' => $query,
        ], 404);
    }

    public function store(Request $request)
    {
        // return $request->all();
        try {
            // Validasi data dari request
            $validatedData = $request->validate([
                'verifikator_id' => 'required',
                'barjas_template_id' => 'required',
                'satker' => 'required|string|max:255',
                'barjas_nama' => 'required|string|max:255',
                'ppk' => 'required|string|max:255',
                'pejabat_pengadaan' => 'required|string|max:255',
                'rekanan' => 'required|string|max:255',
                'metode' => 'required|string|max:255',
                'tanggal_kontrak' => 'required|date',
                'nilai' => 'required|string|max:255',
                'kode_akun' => 'required|string|max:255',
                // 'jumlah_dokumen' => 'required|string|max:255',
                'tanggal_periksa' => 'required|date',
            ]);
            $barjasSesi = BarjasSesi::create($validatedData);
            return response()->json([
                'message' => 'Data Barjas Sesi berhasil disimpan.',
                'data' => $barjasSesi,
            ], 201);
        } catch (ValidationException $e) {
            // Tangkap kesalahan validasi dan kirimkan respons dengan status 422 Unprocessable Entity
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Tangkap kesalahan umum dan rollback transaksi jika terjadi kesalahan
            // DB::rollBack();

            // Kembalikan respons dengan status 500 Internal Server Error
            return response()->json(['error' => $e], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi data dari request
            $validatedData = $request->validate([
                'verifikator_id' => 'required',
                'barjas_template_id' => 'required',
                'satker' => 'required|string|max:255',
                'barjas_nama' => 'required|string|max:255',
                'ppk' => 'required|string|max:255',
                'pejabat_pengadaan' => 'required|string|max:255',
                'rekanan' => 'required|string|max:255',
                'metode' => 'required|string|max:255',
                'tanggal_kontrak' => 'required|date',
                'nilai' => 'required|string|max:255',
                'kode_akun' => 'required|string|max:255',
                // 'jumlah_dokumen' => 'required|string|max:255',
                'tanggal_periksa' => 'required|date',
            ]);

            // Temukan BarjasSesi berdasarkan ID
            $barjasSesi = BarjasSesi::findOrFail($id);

            // Perbarui BarjasSesi dengan data yang divalidasi
            $barjasSesi->update($validatedData);

            return response()->json([
                'message' => 'Data Barjas berhasil diperbarui.',
                'data' => $barjasSesi,
            ], 200);
        } catch (ValidationException $e) {
            // Tangkap kesalahan validasi dan kirimkan respons dengan status 422 Unprocessable Entity
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Tangkap kesalahan umum dan kembalikan respons dengan status 500 Internal Server Error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        // Cari BarjasSesi berdasarkan ID
        $barjasSesi = BarjasSesi::find($id);
        // return $barjasSesi;

        // Jika tidak ditemukan, kembalikan respons dengan status 404
        if (!$barjasSesi) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        // Hapus BarjasSesi
        $barjasSesi->delete();

        // Kembalikan respons sukses
        return response()->json([
            'status' => true,
            'message' => 'Data dihapus',
            'data' => $barjasSesi,
        ], 200);
    }
}
