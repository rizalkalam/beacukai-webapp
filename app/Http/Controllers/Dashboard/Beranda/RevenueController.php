<?php

namespace App\Http\Controllers\Dashboard\Beranda;

use App\Models\Revenue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RevenueController extends Controller
{
    public function index()
    {
        $data = Revenue::select([
            'nominal',
            'date'
        ])
        ->first();

        // Memformat nominal sebelum menambahkannya ke respons JSON
        $formattedNominal = number_format($data->nominal, 0, ',', '.');

        return response()->json([
            'success' => true,
            'message' => 'Data revenue',
            'data' => [
                'nominal' => $formattedNominal,
                'date' => $data->date,
            ],
        ]);
    }

    public function change(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nominal' => 'required',
            'date' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $revenue_id = Revenue::select('id')->first();

            $revenue_id->update([
                'nominal' => request('nominal'),
                'date' => request('date')
            ]);

            return response()->json([
                'message' => 'Data revenue success changed',
                'data' => $revenue_id 
            ], 200);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'failed',
                'errors' => $th->getMessage(),
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data revenue',
            'data' => $id,
        ]);
    }
}
