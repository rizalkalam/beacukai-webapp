<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\ServicePromise;
use App\Http\Controllers\Controller;

class JanjiLayananClientController extends Controller
{
    public function getServicePromise()
    {
        $data = ServicePromise::get();

        return response()->json([
            "success" => true,
            "message" => "Janji Layanan",
            "data" => $data,
        ], 200);
    }
}
