<?php

namespace App\Http\Controllers\Client;

use App\Models\MainService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LayananUtamaController extends Controller
{
    public function getMainServiceCategory()
    {
        $data = MainService::select([
            'id',
            'name'
        ])->get(); 

        return response()->json([
            'success' => true,
            'message' => 'main_service_category',
            'data' => $data,
        ]);
    }

    public function getMainServiceById($id)
    {
        $data = MainService::where('id', $id)
        ->get();

        if ($data->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'main_service',
            'data' => $data,
        ]);
    }

    public function getMainServiceByCategory()
    {
        $categoryName = request('category', null);

        $data = MainService::when($categoryName, function ($query) use ($categoryName) {
            return $query->where('name', $categoryName);
        })->get();

        if ($data->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'main_service',
            'data' => $data,
        ]);
    }
}
