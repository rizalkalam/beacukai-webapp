<?php

namespace App\Http\Controllers\Dashboard\Beranda;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    public function index()
    {
        $data = Photo::get();

        return response()->json([
            'success' => true,
            'message' => 'List data photo',
            'data' => $data,
        ]);
    }

    public function getPhotoById($id)
    {
        $data = Photo::where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data photo by id',
            'data' => $data,
        ]);
    }

    public function store_photo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'file' => 'mimes:jpeg,png,jpg,gif,svg|file|max:3048',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            //photo
            $file = $request->file('file');
            $photo_name = $file->getClientOriginalName();

            $data = Photo::create([
                'title' => request('title'),
                'file' => $file->storeAs('photos', $photo_name),
                'description' => request('description')
            ]);

            return response()->json([
                'message' => 'Store photo success',
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

    public function update_photo(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'file' => 'nullable',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $data = Photo::where('id', $id)
            ->first();

            if (!$data) {
                return response()->json([
                    'message' => 'Data not found',
                    'data' => [],
                ], 404);
            }

            if ($request->hasFile('file')) {
                Storage::delete($data->file);
                $file = $request->file('file');
                $photo_name = $file->getClientOriginalName();
                $file_request = $file->storeAs('photos', $photo_name);
            } else {
                $file_request = $data->file;
            }

            $data->update([
                'title' => request('title'),
                'file' => $file_request,
                'description' => request('description')
            ]);

            return response()->json([
                'message' => 'Update photo success',
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

    public function delete_photo($id)
    {
        // hapus file
        $file = Photo::where('id', $id)->value('file');
        Storage::delete($file);

        // hapus data
        $photo = Photo::where('id', $id)->first();
        $photo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data photo deleted',
        ]);
    }
}
