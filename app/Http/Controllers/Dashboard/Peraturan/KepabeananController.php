<?php

namespace App\Http\Controllers\Dashboard\Peraturan;

use App\Models\Kepabeanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KepabeananController extends Controller
{
    public function getByRegulationId($id)
    {
        $data = Kepabeanan::join('kepabeanan_regulations', 'kepabeanan_regulations.id', '=', 'kepabeanans.regulation_id')
        ->where('regulation_id', $id)
        ->select([
            'kepabeanans.title',
            'kepabeanans.file'
        ])
        ->get();

        return response()->json([
            "success" => true,
            "message" => "kepabeanan",
            "data" => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf',
            'regulation_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file->storeAs('file_kepabeanan', $file_name);

            $data = Kepabeanan::create([
                'title' => $file_name,
                'file' => 'file_kepabeanan/' . $file_name,
                'regulation_id' => request('regulation_id'),
            ]);

            return response()->json([
                'message' => 'Store file success',
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
        // hapus file
        $file = Kepabeanan::where('id', $id)->value('file');
        Storage::delete($file);

        // hapus data
        $kepabeanan = Kepabeanan::where('id', $id)->first();
        $kepabeanan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data kepabeanan deleted',
        ]);
    }
}
