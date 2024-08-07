<?php

namespace App\Http\Controllers\Dashboard\Beranda;

use App\Models\FaqCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FaqCategoryController extends Controller
{
    public function getFaqCategory()
    {
        $data = FaqCategory::select([
            'id',
            'name'
        ])
        ->get();

        return response()->json([
            "success" => true,
            "message" => "Kategori FAQ",
            "data" => $data,
        ], 200);
    }

    public function getFaqCategoryById($id)
    {
        $data = FaqCategory::where('id', $id)->first();

        return response()->json([
            "success" => true,
            "message" => "faq category by id",
            "data" => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $data_check = FaqCategory::where('name', request('name'))->exists();
            if (!$data_check) {
                $data = FaqCategory::create([
                    'name' => request('name')
                ]);
    
                return response()->json([
                    'message' => 'Data success created',
                    'data' => $data,
                ]);
            } else {
                return response()->json([
                    'message' => 'failed',
                    'errors' => 'Category names are available',
                ], 400);
            }
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
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $data_check = FaqCategory::where('name', request('name'))->exists();

            if (!$data_check) {
                $data = FaqCategory::where('id', $id)->first();

                $data->update([
                    'name' => request('name')
                ]);

                return response()->json([
                    'message' => 'Data success updated',
                    'data' => $data,
                ]);
            } else {
                return response()->json([
                    'message' => 'failed',
                    'errors' => 'Category names are available',
                ], 400);
            }
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
        $data = FaqCategory::where('id', $id)->first();

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data success deleted',
        ]);
    }
}
