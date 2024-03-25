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

    public function contentByRegulation()
    {
        $regulationName = request('regulation', null);

        $data = Cukai::join('cukai_regulations', 'cukai_regulations.id', '=', 'cukais.regulation_id')
        ->when($regulationName, function ($query) use ($regulationName) {
            return $query->whereHas('regulation', function ($query) use ($regulationName) {
                $query->where('regulation_name', $regulationName);
            });
        })
        ->select([
            'cukais.id',
            'cukais.title',
            'cukais.file',
            'cukais.regulation_id',
            'cukai_regulations.regulation_name'
        ])
        ->get();

        $dataRegulation = CukaiRegulation::where('regulation_name', $data->first()->regulation_name)->first();

        return response()->json([
            "success" => true,
            "message" => "peraturan cukai berdasarkan id peraturan",
            "name_regulation" => $dataRegulation->regulation_name,
            "data" => $data,
        ], 200);
    }
}
