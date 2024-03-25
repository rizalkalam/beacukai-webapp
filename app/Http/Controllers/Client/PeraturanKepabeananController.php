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
        $regulationName = request('regulation', null);

        $data = Kepabeanan::join('kepabeanan_regulations', 'kepabeanan_regulations.id', '=', 'kepabeanans.regulation_id')
        ->when($regulationName, function ($query) use ($regulationName) {
            return $query->whereHas('regulation', function ($query) use ($regulationName) {
                $query->where('regulation_name', $regulationName);
            });
        })
        ->select([
            'kepabeanans.id',
            'kepabeanans.title',
            'kepabeanans.file',
            'kepabeanans.regulation_id',
            'kepabeanan_regulations.regulation_name'
        ])
        ->get();

        $dataRegulation = KepabeananRegulation::where('regulation_name', $data->first()->regulation_name)->first();

        return response()->json([
            "success" => true,
            "message" => "peraturan kepabeanan berdasarkan id peraturan",
            "name_regulation" => $dataRegulation->regulation_name,
            "data" => $data,
        ], 200);
    }
}
