<?php

namespace App\Http\Controllers\Dashboard\Peraturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KepabeananRegulation;
use Illuminate\Support\Facades\Validator;

class KepabeananRegulationController extends Controller
{
    public function index()
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

    public function getRegulationById($regulation_id)
    {
        $data = KepabeananRegulation::where('id', $regulation_id)->first();

        return response()->json([
            "success" => true,
            "message" => "detail peraturan cukai",
            "data" => $data,
        ], 200);
    }
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'regulation_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $regulation = KepabeananRegulation::create([
                'regulation_name' => request('regulation_name')
            ]);

            return response()->json([
                'message' => 'Data success created',
                'data' => $regulation,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'failed',
                'errors' => $th->getMessage(),
            ], 400);
        }
    }

    public function update(Request $request, $regulation_id)
    {
        $validator = Validator::make($request->all(), [
            'regulation_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $regulation = KepabeananRegulation::where('id', $regulation_id)->first();

            $regulation->update([
                'regulation_name' => request('regulation_name')
            ]);

            return response()->json([
                'message' => 'Data success updated',
                'data' => $regulation,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'failed',
                'errors' => $th->getMessage(),
            ], 400);
        }
    }

    public function delete($regulation_id)
    {
        $regulation_id = KepabeananRegulation::where('id', $regulation_id)->first();

        $regulation_id->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data success deleted',
        ]);
    }
}
