<?php

namespace App\Http\Controllers\SPI;

use App\Http\Controllers\Controller;
use App\Models\BarjasSesiPeriksa;
use Illuminate\Http\Request;

class BarjasSesiPeriksaController extends Controller
{
    //
    public function store(Request $request)
    {
        // return $request->all();
        try {
            // Validasi data dari request
            $validatedData = $request->validate([
                'barjas_sesi_id' => 'required',
                'barjas_template_item_id' => 'required',
                'tanggal_dokumen' => 'nullable|date',
            ]);

            $barjasSesi = BarjasSesiPeriksa::create($validatedData);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan.',
                'data' => $barjasSesi,
            ], 201);
        } catch (ValidationException $e) {
            // Tangkap kesalahan validasi dan kirimkan respons dengan status 422 Unprocessable Entity
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Kembalikan respons dengan status 500 Internal Server Error
            return response()->json(['error' => $e], 500);
        }
    }

    public function destroy($id)
    {
        // Cari BarjasSesi berdasarkan ID
        $data = BarjasSesiPeriksa::find($id);
        // return $barjasSesi;

        // Jika tidak ditemukan, kembalikan respons dengan status 404
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        // Hapus BarjasSesi
        $data->delete();

        // Kembalikan respons sukses
        return response()->json([
            'status' => true,
            'message' => 'Data dihapus',
            'data' => $data,
        ], 200);
    }
}
