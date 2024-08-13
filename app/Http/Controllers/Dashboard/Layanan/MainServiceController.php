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
        $data = MainService::get()
        ->select([
            'id',
            'name'
        ]);

        // $names = $data->pluck('name'); 

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

        return response()->json([
            'success' => true,
            'message' => 'main_service',
            'data' => $data,
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required',
            'judul_layanan' => 'nullable',
            'keterangan_layanan' => 'nullable',
            'judul_gambar_layanan_1' => 'nullable',
            'gambar_layanan_1' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:3048',
            'judul_gambar_layanan_2' => 'nullable',
            'gambar_layanan_2' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:3048',
            'judul_alur_layanan' => 'nullable',
            'keterangan_alur_layanan' => 'nullable',
            'judul_gambar_penunjang_layanan_1' => 'nullable',
            'gambar_penunjang_layanan_1' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:3048',
            'keterangan_penunjang_layanan_1' => 'nullable',
            'judul_gambar_penunjang_layanan_2' => 'nullable',
            'gambar_penunjang_layanan_2' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:3048',
            'keterangan_penunjang_layanan_2' => 'nullable',
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

            if ($request->hasFile('gambar_layanan_1')) {
                $image_1 = $request->file('gambar_layanan_1');
                $filePaths['service_image_1'] = $image_1->storeAs('service_image', uniqid() . '_' . $image_1->getClientOriginalName());
            }
    
            if ($request->hasFile('gambar_layanan_2')) {
                $image_2 = $request->file('gambar_layanan_2');
                $filePaths['service_image_2'] = $image_2->storeAs('service_image', uniqid() . '_' . $image_2->getClientOriginalName());
            }
    
            if ($request->hasFile('gambar_penunjang_layanan_1')) {
                $image_3 = $request->file('gambar_penunjang_layanan_1');
                $filePaths['supporting_image_1'] = $image_3->storeAs('supporting_image', uniqid() . '_' . $image_3->getClientOriginalName());
            }
    
            if ($request->hasFile('gambar_penunjang_layanan_2')) {
                $image_4 = $request->file('gambar_penunjang_layanan_2');
                $filePaths['supporting_image_2'] = $image_4->storeAs('supporting_image', uniqid() . '_' . $image_4->getClientOriginalName());
            }

            $data = MainService::create([
                'name' => request('nama_layanan'),
                'title' => request('judul_layanan'),
                'service_description' => request('keterangan_layanan'),
                'title_service_image_1' => request('judul_gambar_layanan_1'),
                'service_image_1' => $filePaths['service_image_1'] ?? null,
                'title_service_image_2' => $request->input('judul_gambar_layanan_2'),
                'service_image_2' => $filePaths['service_image_2'] ?? null,
                'title_service_flow' => $request->input('judul_alur_layanan'),
                'description_of_service_flow' => $request->input('keterangan_alur_layanan'),
                'title_supporting_image_1' => $request->input('judul_gambar_penunjang_layanan_1'),
                'supporting_image_1' => $filePaths['supporting_image_1'] ?? null,
                'description_of_supporting_1' => $request->input('keterangan_penunjang_layanan_1'),
                'title_supporting_image_2' => $request->input('judul_gambar_penunjang_layanan_2'),
                'supporting_image_2' => $filePaths['supporting_image_2'] ?? null,
                'description_of_supporting_2' => request('keterangan_penunjang_layanan_2'),
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
            'judul_layanan' => 'nullable',
            'keterangan_layanan' => 'nullable',
            'judul_gambar_layanan_1' => 'nullable',
            'gambar_layanan_1' => 'nullable|image',
            'judul_gambar_layanan_2' => 'nullable',
            'gambar_layanan_2' => 'nullable|image',
            'judul_alur_layanan' => 'nullable',
            'keterangan_alur_layanan' => 'nullable',
            'judul_gambar_penunjang_layanan_1' => 'nullable',
            'gambar_penunjang_layanan_1' => 'nullable|image',
            'keterangan_penunjang_layanan_1' => 'nullable',
            'judul_gambar_penunjang_layanan_2' => 'nullable',
            'gambar_penunjang_layanan_2' => 'nullable|image',
            'keterangan_penunjang_layanan_2' => 'nullable',
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

             // Cek dan simpan file gambar baru jika ada
            if ($request->hasFile('gambar_layanan_1')) {
                // Hapus file lama
                if ($data->service_image_1) {
                    Storage::delete($data->service_image_1);
                }
                $image_1 = $request->file('gambar_layanan_1');
                $filePaths['service_image_1'] = $image_1->storeAs('service_image', uniqid() . '_' . $image_1->getClientOriginalName());
            } else {
                // Hapus file lama jika tidak ada file baru
                if ($data->service_image_1) {
                    Storage::delete($data->service_image_1);
                }
                $filePaths['service_image_1'] = null;
            }

            if ($request->hasFile('gambar_layanan_2')) {
                // Hapus file lama
                if ($data->service_image_2) {
                    Storage::delete($data->service_image_2);
                }
                $image_2 = $request->file('gambar_layanan_2');
                $filePaths['service_image_2'] = $image_2->storeAs('service_image', uniqid() . '_' . $image_2->getClientOriginalName());
            } else {
                // Hapus file lama jika tidak ada file baru
                if ($data->service_image_2) {
                    Storage::delete($data->service_image_2);
                }
                $filePaths['service_image_2'] = null;
            }

            if ($request->hasFile('gambar_penunjang_layanan_1')) {
                // Hapus file lama
                if ($data->supporting_image_1) {
                    Storage::delete($data->supporting_image_1);
                }
                $image_3 = $request->file('gambar_penunjang_layanan_1');
                $filePaths['supporting_image_1'] = $image_3->storeAs('supporting_image', uniqid() . '_' . $image_3->getClientOriginalName());
            } else {
                // Hapus file lama jika tidak ada file baru
                if ($data->supporting_image_1) {
                    Storage::delete($data->supporting_image_1);
                }
                $filePaths['supporting_image_1'] = null;
            }

            if ($request->hasFile('gambar_penunjang_layanan_2')) {
                // Hapus file lama
                if ($data->supporting_image_2) {
                    Storage::delete($data->supporting_image_2);
                }
                $image_4 = $request->file('gambar_penunjang_layanan_2');
                $filePaths['supporting_image_2'] = $image_4->storeAs('supporting_image', uniqid() . '_' . $image_4->getClientOriginalName());
            } else {
                // Hapus file lama jika tidak ada file baru
                if ($data->supporting_image_2) {
                    Storage::delete($data->supporting_image_2);
                }
                $filePaths['supporting_image_2'] = null;
            }

            $data->update([
                'name' => request('nama_layanan'),
                'title' => request('judul_layanan'),
                'service_description' => request('keterangan_layanan'),
                'title_service_image_1' => request('judul_gambar_layanan_1'),
                'service_image_1' => $filePaths['service_image_1'],
                'title_service_image_2' => request('judul_gambar_layanan_2'),
                'service_image_2' => $filePaths['service_image_2'],
                'title_service_flow' => request('judul_alur_layanan'),
                'description_of_service_flow' => request('keterangan_alur_layanan'),
                'title_supporting_image_1' => request('judul_gambar_penunjang_layanan_1'),
                'supporting_image_1' => $filePaths['supporting_image_1'],
                'description_of_supporting_1' => request('keterangan_penunjang_layanan_1'),
                'title_supporting_image_2' => request('judul_gambar_penunjang_layanan_2'),
                'supporting_image_2' => $filePaths['supporting_image_2'],
                'description_of_supporting_2' => request('keterangan_penunjang_layanan_2'),
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
            // Hapus file gambar jika ada
            if ($data->service_image_1) {
                Storage::delete($data->service_image_1);
            }
    
            if ($data->service_image_2) {
                Storage::delete($data->service_image_2);
            }
    
            if ($data->supporting_image_1) {
                Storage::delete($data->supporting_image_1);
            }
    
            if ($data->supporting_image_2) {
                Storage::delete($data->supporting_image_2);
            }
    
            // Hapus data dari database
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
