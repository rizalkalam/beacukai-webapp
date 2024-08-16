<?php

namespace App\Http\Controllers\Client;

use App\Models\Photo;
use App\Models\Video;
use App\Models\Banner;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class BerandaController extends Controller
{
    public function banners()
    {
        $data = Banner::get();

        return response()->json([
            "success" => true,
            "message" => "banner",
            "data" => $data,
        ], 200);
    }

    Public function videos()
    {
        $data = Video::get();

        return response()->json([
            "success" => true,
            "message" => "video",
            "data" => $data,
        ], 200);
    }

    public function photos()
    {
        $data = Photo::get();

        return response()->json([
            "success" => true,
            "message" => "photo",
            "data" => $data,
        ], 200);
    }

    public function photoById($id)
    {
        $data = Photo::where('id', $id)->first();

        return response()->json([
            "success" => true,
            "message" => "photo by id",
            "data" => $data,
        ], 200);
    }

    public function revenue()
    {
        $data = Revenue::first();

        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');

        $data_formatout = ([
            'nominal' => $data->nominal,
            'date' => Carbon::parse($data->date)->isoFormat('D MMMM Y')
        ]);

        return response()->json([
            "success" => true,
            "message" => "revenue",
            "data" => $data_formatout,
        ], 200);
    }
}
