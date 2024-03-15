<?php

namespace App\Http\Controllers\Client;

use App\Models\Kepabeanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KepabeananRegulation;

class PeraturanKepabeananController extends Controller
{
    public function regulation()
    {
        $data = KepabeananRegulation::select([
            'id',
            'regulation_name'
        ])->get();

        return response()->json([
            "success" => true,
            "message" => "peraturan kepabeanan",
            "data" => $data,
        ], 200);
    }

    public function contentByRegulation($id)
    {
        $data = Kepabeanan::where('regulation_id', $id)
        ->get();

        return response()->json([
            "success" => true,
            "message" => "peraturan kepabeanan berdasarkan id peraturan",
            "data" => $data,
        ], 200);
    }
}
