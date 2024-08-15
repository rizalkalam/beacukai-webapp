<?php

namespace App\Http\Controllers\Dashboard\Layanan;

use App\Models\MainService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MainServiceController extends Controller
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

    private function storeImage($image)
    {
        return $image->storeAs('service_image', uniqid() . '_' . $image->getClientOriginalName());
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required',
            'sub_judul_1' => 'nullable',
            'gambar_1' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:3048',
            'keterangan_1' => 'nullable',
            'sub_judul_2' => 'nullable',
            'gambar_2' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:3048',
            'keterangan_2' => 'nullable',
            'sub_judul_3' => 'nullable',
            'gambar_3' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:3048',
            'keterangan_3' => 'nullable',
            'sub_judul_4' => 'nullable',
            'gambar_4' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:3048',
            'keterangan_4' => 'nullable',
            'sub_judul_5' => 'nullable',
            'gambar_5' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:3048',
            'keterangan_5' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $filePaths = [];
            for ($i = 1; $i <= 5; $i++) {
                $imageKey = "gambar_$i";
                if ($request->hasFile($imageKey)) {
                    $filePaths["image_$i"] = $this->storeImage($request->file($imageKey));
                }
            }

            $data = MainService::create([
                'name' => request('nama_layanan'),
                'sub_title_1' => request('sub_judul_1'),
                'image_1' => $filePaths['image_1'] ?? null,
                'information_1' => $request->input('keterangan_1'),
                'sub_title_2' => request('sub_judul_2'),
                'image_2' => $filePaths['image_2'] ?? null,
                'information_2' => $request->input('keterangan_2'),
                'sub_title_3' => request('sub_judul_3'),
                'image_3' => $filePaths['image_3'] ?? null,
                'information_3' => $request->input('keterangan_3'),
                'sub_title_4' => request('sub_judul_4'),
                'image_4' => $filePaths['image_4'] ?? null,
                'information_4' => $request->input('keterangan_4'),
                'sub_title_5' => request('sub_judul_5'),
                'image_5' => $filePaths['image_5'] ?? null,
                'information_5' => $request->input('keterangan_5'),
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
            'nama_layanan' => 'required',
            'sub_judul_1' => 'nullable',
            'gambar_1' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:3048',
            'keterangan_1' => 'nullable',
            'sub_judul_2' => 'nullable',
            'gambar_2' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:3048',
            'keterangan_2' => 'nullable',
            'sub_judul_3' => 'nullable',
            'gambar_3' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:3048',
            'keterangan_3' => 'nullable',
            'sub_judul_4' => 'nullable',
            'gambar_4' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:3048',
            'keterangan_4' => 'nullable',
            'sub_judul_5' => 'nullable',
            'gambar_5' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:3048',
            'keterangan_5' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $data = MainService::where('id', $id)
            ->first();

            if (!$data) {
                return response()->json([
                    'message' => 'Data not found',
                ], 404);
            }
            
            $filePaths = [];
            for ($i = 1; $i <= 5; $i++) {
                $imageKey = "gambar_$i";
                $existingImage = $data->{"image_$i"};
                
                if ($request->hasFile($imageKey)) {
                    // Hapus file lama
                    if ($existingImage) {
                        Storage::delete($existingImage);
                    }
                    $filePaths["image_$i"] = $request->file($imageKey)->storeAs(
                        'service_image', 
                        uniqid() . '_' . $request->file($imageKey)->getClientOriginalName()
                    );
                } else {
                    $filePaths["image_$i"] = $existingImage;
                }
            }

            $data->update([
                'name' => request('nama_layanan'),
                'sub_title_1' => request('sub_judul_1'),
                'image_1' => $filePaths['image_1'] ?? null,
                'information_1' => $request->input('keterangan_1'),
                'sub_title_2' => request('sub_judul_2'),
                'image_2' => $filePaths['image_2'] ?? null,
                'information_2' => $request->input('keterangan_2'),
                'sub_title_3' => request('sub_judul_3'),
                'image_3' => $filePaths['image_3'] ?? null,
                'information_3' => $request->input('keterangan_3'),
                'sub_title_4' => request('sub_judul_4'),
                'image_4' => $filePaths['image_4'] ?? null,
                'information_4' => $request->input('keterangan_4'),
                'sub_title_5' => request('sub_judul_5'),
                'image_5' => $filePaths['image_5'] ?? null,
                'information_5' => $request->input('keterangan_5'),
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
        $data = MainService::where('id', $id)
        ->first();
        
        if (!$data) {
            return response()->json([
                'message' => 'Data not found',
            ], 404);
        }

        try {
            $imageKeys = ['image_1', 'image_2', 'image_3', 'image_4', 'image_5'];

            foreach ($imageKeys as $imageKey) {
                // Hapus file gambar jika ada
                if ($data->$imageKey) {
                    Storage::delete($data->$imageKey);
                }
            }
    
            $data->delete();
    
            return response()->json([
                'message' => 'Data successfully deleted',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to delete data',
                'errors' => $th->getMessage(),
            ], 400);
        }
    }
}
