<?php

namespace App\Http\Controllers\Dashboard\Beranda;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index()
    {
        $data = Banner::get();

        return response()->json([
            'success' => true,
            'message' => 'List data banner',
            'data' => $data,
        ]);
    }

    public function store_banner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg|file|max:3048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first('file'),
                'data' => [],
            ], 400);
        }

        try {
            //banner
            $file = $request->file('file');
            $banner_name = $file->getClientOriginalName();

            $data = Banner::create([
                'file' => $file->storeAs('banners', $banner_name)
            ]);

            return response()->json([
                'message' => 'Store banner success',
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

    public function delete_banner($id)
    {
        // hapus file
        $file = Banner::where('id', $id)->value('file');
        Storage::delete($file);

        // hapus data
        $banner = Banner::where('id', $id)->first();
        $banner->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data banner deleted',
        ]);
    }
}
