<?php

namespace App\Http\Controllers\Dashboard\Beranda;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function getService()
    {
        $data = Service::get();

        return response()->json([
            "success" => true,
            "message" => "layanan",
            "data" => $data,
        ], 200);
    }

    public function getServiceById($id)
    {
        $data = Service::where('id', $id)->first();

        return response()->json([
            "success" => true,
            "message" => "layanan",
            "data" => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'link' => 'required',
            'icon' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $data = Service::create([
                'name' => request('name'),
                'link' => request('link'),
                'icon' => request('icon')
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
            'link' => 'required',
            'icon' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $service = Service::where('id', $id)
            ->first();

            $service->update([
                'name' => request('name'),
                'link' => request('link'),
                'icon' => request('icon')
            ]);

            return response()->json([
                'message' => 'Data success updated',
                'data' => $service,
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
        $service_id = Service::where('id', $id)->first();

        $service_id->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data success deleted',
        ]);
    }
}
