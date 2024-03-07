<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Models\SopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SopCategoryController extends Controller
{
    public function index()
    {
        $data = SopCategory::get();

        return response()->json([
            "success" => true,
            "message" => "SOP",
            "data" => $data,
        ], 200);
    }

    public function getSopById($id)
    {
        $data = SopCategory::where('id', $id)->first();

        return response()->json([
            "success" => true,
            "message" => "SOP",
            "data" => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'link' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $data = SopCategory::create([
                'name' => request('name'),
                'link' => request('link')
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
            'link' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $sop = SopCategory::where('id', $id)
            ->first();

            $sop->update([
                'name' => request('name'),
                'link' => request('link')
            ]);

            return response()->json([
                'message' => 'Data success updated',
                'data' => $sop,
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
        $sop_id = SopCategory::where('id', $id)->first();

        $sop_id->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data success deleted',
        ]);
    }
}
