<?php

namespace App\Http\Controllers\Dashboard\Profile;

use Illuminate\Http\Request;
use App\Models\UserSatisfaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserSatisfactionController extends Controller
{
    public function getUserSatisfaction()
    {
        $data = UserSatisfaction::get();

        return response()->json([
            "success" => true,
            "message" => "Indeks Kepuasan Pengguna",
            "data" => $data,
        ], 200);
    }

    public function getUserSatisfactionById($id)
    {
        $data = UserSatisfaction::where('id', $id)->first();

        return response()->json([
            "success" => true,
            "message" => "Indeks Kepuasan Pengguna By id",
            "data" => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'value' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $data = UserSatisfaction::create([
                'date' => request('date'),
                'value' => request('value')
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
            'date' => 'required',
            'value' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $data = UserSatisfaction::where('id', $id)
            ->first();

            $data->update([
                'date' => request('date'),
                'value' => request('value')
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
        $data = UserSatisfaction::where('id', $id)->first();

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data success deleted',
        ]);
    }
}
