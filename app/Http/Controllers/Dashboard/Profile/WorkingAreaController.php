<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Models\WorkingArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WorkingAreaController extends Controller
{
    public function getServiceUser()
    {
        $data = WorkingArea::first();

        return response()->json([
            "success" => true,
            "message" => "Pengguna Jasa",
            "data" => $data,
        ], 200);
    }

    public function changeTobacco(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tobacco' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $service_id = WorkingArea::select('id')->first();

            $service_id->update([
                'tobacco' => request('tobacco'),
            ]);

            return response()->json([
                'message' => 'Data service tobacco success changed',
                'data' => $service_id 
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed',
                'errors' => $th->getMessage(),
            ], 400);
        }
    }

    public function changeTpeMmeaEa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tpe_mmea_ea' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $service_id = WorkingArea::select('id')->first();

            $service_id->update([
                'tpe_mmea_ea' => request('tpe_mmea_ea'),
            ]);

            return response()->json([
                'message' => 'Data service tpe_mmea_ea success changed',
                'data' => $service_id 
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed',
                'errors' => $th->getMessage(),
            ], 400);
        }
    }

    public function changeBondedStoragePlace(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bonded_storage_place' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $service_id = WorkingArea::select('id')->first();

            $service_id->update([
                'bonded_storage_place' => request('bonded_storage_place'),
            ]);

            return response()->json([
                'message' => 'Data service bonded_storage_place success changed',
                'data' => $service_id 
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed',
                'errors' => $th->getMessage(),
            ], 400);
        }
    }
}
