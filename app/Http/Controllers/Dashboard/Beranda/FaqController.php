<?php

namespace App\Http\Controllers\Dashboard\Beranda;

use App\Models\FaqContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function getByCategoryId($category_id)
    {
        $data = FaqContent::join('faq_categories', 'faq_categories.id', '=', 'faq_contents.category_id')
        ->where('category_id', $category_id)
        ->select([
            'faq_categories.name as category',
            'faq_contents.title',
            'faq_contents.description'
        ])
        ->get();

        return response()->json([
            "success" => true,
            "message" => "faq",
            "category_name" => $data->first()->category,
            "data" => $data,
        ], 200);
    }

    public function getFaqContentById($id)
    {
        $data = FaqContent::where('id', $id)->first();

        return response()->json([
            "success" => true,
            "message" => "faq",
            "data" => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $data = FaqContent::create([
                'title' => request('title'),
                'description' => request('description'),
                'category_id' => request('category_id'),
            ]);

            return response()->json([
                'message' => 'create success',
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
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $data = FaqContent::where('id', $id)->first();

            $data->update([
                'title' => request('title'),
                'description' => request('description'),
                'category_id' => request('category_id'),
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
        $data = FaqContent::where('id', $id)->first();

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data success deleted',
        ]);
    }
}
