<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrganizationalStructure;

class StrukturController extends Controller
{
    public function index()
    {
        $data = OrganizationalStructure::first();

        return response()->json([
            'success' => true,
            'message' => 'struktur organisasi',
            'data' => $data,
        ]);
    }
}
