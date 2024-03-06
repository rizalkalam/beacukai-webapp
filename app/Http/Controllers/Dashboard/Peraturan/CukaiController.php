<?php

namespace App\Http\Controllers\Dashboard\Peraturan;

use App\Models\Cukai;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CukaiController extends Controller
{
    public function getByRegulationId($id)
    {
        $data = Cukai::join('cukai_regulations', 'cukai_regulations.id', '=', 'cukais.regulation_id')
        ->where('regulation_id', $id)
        ->get();

        return response()->json([
            "success" => true,
            "message" => "cukai",
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
            $file->storeAs('file_cukai', $file_name);

            $data = Cukai::create([
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
        $file = Cukai::where('id', $id)->value('file');
        Storage::delete($file);

        // hapus data
        $cukai = Cukai::where('id', $id)->first();
        $cukai->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data cukai deleted',
        ]);
    }
}
