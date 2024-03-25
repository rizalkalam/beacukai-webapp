<?php

namespace App\Http\Controllers\Client;

use App\Models\Achievement;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class PrestasiController extends Controller
{
    public function achievement()
    {
        $data = Achievement::select([
            'id',
            'title',
            'date',
            \DB::raw('YEAR(date) as year')
        ])
        ->get();

        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
        
        foreach ($data as $achievement) {
            $achievement->date = Carbon::parse($achievement->date)->isoFormat('D MMMM Y');
        }

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
