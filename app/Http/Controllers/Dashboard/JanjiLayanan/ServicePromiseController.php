<?php

namespace App\Http\Controllers\Dashboard\JanjiLayanan;

use Illuminate\Http\Request;
use App\Models\ServicePromise;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ServicePromiseController extends Controller
{
    public function getServicePromise()
    {
        $data = ServicePromise::get();

        return response()->json([
            "success" => true,
            "message" => "Janji Layanan",
            "data" => $data,
        ], 200);
    }

    public function getServicePromiseById($id)
    {
        $data = ServicePromise::where('id', $id)->first();

        return response()->json([
            "success" => true,
            "message" => "Janji Layanan",
            "data" => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'time' => 'required',
            'cost' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $data = ServicePromise::create([
                'name' => request('name'),
                'time' => request('time'),
                'cost' => request('cost')
            ]);

            return response()->json([
                'message' => 'Data success created',
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'failed',
                'errors' => $th->getMessage(),
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'time' => 'required',
            'cost' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $data = ServicePromise::where('id', $id)
            ->first();

            $data->update([
                'name' => request('name'),
                'time' => request('time'),
                'cost' => request('cost')
            ]);

            return response()->json([
                'message' => 'Data success updated',
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'failed',
                'errors' => $th->getMessage(),
            ], 400);
        }
    }

    public function delete($id)
    {
        $data = ServicePromise::where('id', $id)->first();

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data success deleted',
        ]);
    }
}
