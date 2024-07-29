<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\UserSatisfaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IndeksKepuasanController extends Controller
{
    public function index()
    {
        $satisfactions = UserSatisfaction::orderBy(DB::raw('YEAR(date)'), 'asc')->get();

        $data = $satisfactions->map(function($satisfaction) {
            return [
                'id' => $satisfaction->id,
                'year' => $satisfaction->date->format('Y'), // Menyimpan tahun saja
                'date' => $satisfaction->date->format('Y-m-d'), // Menyimpan tanggal lengkap
                'precentage' => $satisfaction->value
            ];
        });

        return response()->json([
            "success" => true,
            "message" => "Indeks Kepuasan Pengguna",
            "data" => $data,
        ], 200);   
    }
}