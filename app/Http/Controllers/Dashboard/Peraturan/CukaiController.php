<?php

namespace App\Http\Controllers\Dashboard\Peraturan;

use App\Models\Cukai;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CukaiRegulation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CukaiController extends Controller
{
    public function getByRegulationId()
    {
        $regulationName = request('regulation', null);

        $data = Cukai::leftjoin('cukai_regulations', 'cukai_regulations.id', '=', 'cukais.regulation_id')
        ->when($regulationName, function ($query) use ($regulationName) {
            return $query->whereHas('regulation', function ($query) use ($regulationName) {
                $query->where('regulation_name', $regulationName);
            });
        })
        ->select([
                'cukai_regulations.id as regulation_id',
                'cukais.id',
                'cukais.title',
                'cukais.file'
        ])
        ->get();

        if ($data->isEmpty()) {
            $regulationId = CukaiRegulation::where('regulation_name', $regulationName)->value('id');
            return response()->json([
                "success" => false,
                "message" => "Data file cukai is empty",
                "regulation_id" => $regulationId,
                "data" => []
            ], 404);
        }

        $dataRegulation = CukaiRegulation::where('regulation_name', $regulationName)->first();

        return response()->json([
            "success" => true,
            "message" => "cukai",
            "name_regulation" => $dataRegulation->regulation_name,
            "regulation_id" => $data->first()->regulation_id,
            "data" => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'file' => 'required|mimes:pdf',
            'regulation_id' => 'required'
            // 'file' => 'required',
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
                'title' => request('title'),
                'file' => 'file_cukai/' . $file_name,
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
        $file = Cukai::where('id', $id)->value('file');

        if (Storage::exists($file)) {
            // hapus file
            Storage::delete($file);

            // hapus data
            $cukai = Cukai::where('id', $id)->first();
            $cukai->delete();
        } else {
            // hapus data
            $cukai = Cukai::where('id', $id)->first();
            $cukai->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Data cukai deleted',
        ]);
    }
}
