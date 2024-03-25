<?php

namespace App\Http\Controllers\Dashboard\Peraturan;

use App\Models\Cukai;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CukaiRegulation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CukaiController extends Controller
{
    public function getByRegulationId()
    {
        // $data = Cukai::join('cukai_regulations', 'cukai_regulations.id', '=', 'cukais.regulation_id')
        // ->where('regulation_id', $id)
        // ->select([
        //     'cukais.title',
        //     'cukais.file'
        // ])
        // ->get();

        $regulationName = request('regulation', null);

        $data = Cukai::join('cukai_regulations', 'cukai_regulations.id', '=', 'cukais.regulation_id')
        ->when($regulationName, function ($query) use ($regulationName) {
            return $query->whereHas('regulation', function ($query) use ($regulationName) {
                $query->where('regulation_name', $regulationName);
            });
        })
        ->select([
                'cukais.id',
                'cukais.title',
                'cukais.file'
        ])
        ->get();

        $dataRegulation = CukaiRegulation::where('regulation_name', $regulationName)->first();

        return response()->json([
            "success" => true,
            "message" => "cukai",
            "name_regulation" => $dataRegulation->regulation_name,
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
