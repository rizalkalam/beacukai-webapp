<?php

namespace App\Http\Controllers\Client;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LayananController extends Controller
{
    public function index()
    {
        $data = Service::get();

        return response()->json([
            "success" => true,
            "message" => "layanan",
            "data" => $data,
        ], 200);
    }
}
