<?php

namespace App\Http\Controllers\Client;

use App\Models\SopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SopController extends Controller
{
    public function index()
    {    
        $data = SopCategory::get();

        return response()->json([
            "success" => true,
            "message" => "data sop",
            "data" => $data,
        ], 200);
    }
}
