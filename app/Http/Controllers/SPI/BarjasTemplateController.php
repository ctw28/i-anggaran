<?php

namespace App\Http\Controllers\SPI;

use App\Http\Controllers\Controller;
use App\Models\BarjasTemplate;
use Illuminate\Http\Request;

class BarjasTemplateController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = BarjasTemplate::query();
        $query->with(['bagian.item.periksa']);
        $query->find(1);
        if ($query->count() > 0)
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $query->get(),
            ], 200);
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan',
            'data' => $query->get(),
        ], 400);
    }
}
