<?php

namespace App\Http\Controllers\Client;

use App\Models\WorkingArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenggunaJasaController extends Controller
{
    public function getWorkingArea()
    {
        $data = WorkingArea::select([
            'id',
            'tobacco as tembakau',
            'tpe_mmea_ea',
            'bonded_storage_place as penimbunan_berikat'
        ])->get();

        return response()->json([
            'success' => true,
            'message' => 'wilayah kerja (pengguna jasa)',
            'data' => $data,
        ]);
    }
}
