<?php

namespace App\Http\Controllers\Client;

use App\Models\Cukai;
use Illuminate\Http\Request;
use App\Models\CukaiRegulation;
use App\Http\Controllers\Controller;

class PeraturanCukaiController extends Controller
{
    public function regulation()
    {
        $data = CukaiRegulation::select([
            'id',
            'regulation_name'
        ])->get();

        return response()->json([
            "success" => true,
            "message" => "peraturan cukai",
            "data" => $data,
        ], 200);
    }

    public function contentByRegulation($id)
    {
        $data = Cukai::where('regulation_id', $id)
        ->get();

        return response()->json([
            "success" => true,
            "message" => "peraturan cukai berdasarkan id peraturan",
            "data" => $data,
        ], 200);
    }
}
