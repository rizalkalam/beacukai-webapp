<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Models\Achievement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AchievementController extends Controller
{
    public function getAchievement()
    {
        $data = Achievement::get();

        return response()->json([
            'success' => true,
            'message' => 'data achievement',
            'data' => $data,
        ]);
    }

    public function getAchievementById($id)
    {
        $data = Achievement::where('id', '=', $id)
        ->first();

        return response()->json([
            'success' => true,
            'message' => 'data achievement',
            'data' => $data,
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
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
            $data = Achievement::create([
                'title' => request('title'),
                'date' => request('date')
            ]);

            return response()->json([
                'message' => 'Store achievement success',
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

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
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
            $achievement = Achievement::where('id', '=', $id)
            ->first();

            $achievement->update([
                'title' => request('title'),
                'date' => request('date')
            ]);

            return response()->json([
                'message' => 'Data achievement success updated',
                'data' => $achievement 
            ], 200);
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
        $achievement = Achievement::where('id', $id)->first();

        $achievement->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data achievement success deleted',
        ]);
    }
}