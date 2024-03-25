<?php

namespace App\Http\Controllers\Dashboard\Beranda;

use App\Models\FaqContent;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function getByCategoryName()
    {
        // $data = FaqContent::leftjoin('faq_categories', 'faq_categories.id', '=', 'faq_contents.category_id')
        // ->where('faq_categories.name', $name)
        // ->select([
        //     'faq_contents.id',
        //     'faq_categories.id as id_category',
        //     'faq_categories.name as category',
        //     'faq_contents.title',
        //     'faq_contents.description'
        // ])
        // ->get();

        $categoryName = request('category', null);

        $data = FaqContent::join('faq_categories', 'faq_categories.id', '=', 'faq_contents.category_id')
            ->when($categoryName, function ($query) use ($categoryName) {
                return $query->whereHas('category', function ($query) use ($categoryName) {
                    $query->where('name', $categoryName);
                });
            })
            ->select([
                'faq_contents.id',
                'faq_categories.id as category_id',
                'faq_categories.name as category',
                'faq_contents.title',
                'faq_contents.description'
            ])
            ->get();

        $dataCategory = FaqCategory::where('name', $categoryName)->first();
        // Check if id_category is null, set it to an empty string if it is null
        // $idCategory = $data->first()->id_category ?? '';
        // $nameCategory = $data->first()->category ?? '';

        return response()->json([
            "success" => true,
            "message" => "faq",
            "id_category" => $dataCategory->id,
            "name_category" => $dataCategory->name,
            "data" => $data,
            // "category_name" => $data->first()->category,
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
