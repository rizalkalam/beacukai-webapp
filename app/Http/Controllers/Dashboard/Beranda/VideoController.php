<?php

namespace App\Http\Controllers\Dashboard\Beranda;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function index()
    {
        $data = Video::get();

        return response()->json([
            'success' => true,
            'message' => 'List data video',
            'data' => $data,
        ]);
    }

    public function video_id($id)
    {
        $data = video::where('id', '=', $id)
        ->first();

        return response()->json([
            'success' => true,
            'message' => 'Data video by id '.$id,
            'data' => $data,
        ]);
    }

    public function store_video(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
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
            $data = Video::create([
                'title' => $request->title,
                'link' => $request->link
            ]);

            return response()->json([
                'message' => 'Store video success',
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

    public function update_video(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
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
            $video_id = Video::where('id', '=', $id)
            ->first();

            $video_id->update([
                'title' => $request->title,
                'link' => $request->link
            ]);

            return response()->json([
                'message' => 'Data video success updated',
                'data' => $video_id 
            ], 200);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'failed',
                'errors' => $th->getMessage(),
            ], 400);
        }
    }

    public function delete_video($id)
    {
        $video_id = Video::where('id', '=', $id)->first();

        $video_id->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data video success deleted',
        ]);
    }
}
