<?php

namespace App\Http\Controllers\Client;

use App\Models\Achievement;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrestasiController extends Controller
{
    public function achievement()
    {
        $data = Achievement::get();

        return response()->json([
            'success' => true,
            'message' => 'prestasi dan apresiasi',
            'data' => $data,
        ]);
    }

    public function certificate()
    {
        $data = Certificate::get();

        return response()->json([
            'success' => true,
            'message' => 'sertifikat',
            'data' => $data,
        ]);
    }
}
