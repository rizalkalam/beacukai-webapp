<?php

namespace App\Http\Controllers\Dashboard\Peraturan;

use App\Models\Kepabeanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KepabeananRegulation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KepabeananController extends Controller
{
    public function getByRegulationId()
    {
        // $data = Kepabeanan::join('kepabeanan_regulations', 'kepabeanan_regulations.id', '=', 'kepabeanans.regulation_id')
        // ->where('regulation_id', $id)
        // ->select([
        //     'kepabeanans.title',
        //     'kepabeanans.file'
        // ])
        // ->get();

        $regulationName = request('regulation', null);

        $data = Kepabeanan::join('kepabeanan_regulations', 'kepabeanan_regulations.id', '=', 'kepabeanans.regulation_id')
        ->when($regulationName, function ($query) use ($regulationName) {
            return $query->whereHas('regulation', function ($query) use ($regulationName) {
                $query->where('regulation_name', $regulationName);
            });
        })
        ->select([
            'kepabeanan_regulations.id as regulation_id',
            'kepabeanans.id',
            'kepabeanans.title',
            'kepabeanans.file'
        ])
        ->get();

        if ($data->isEmpty()) {
            $regulationId = KepabeananRegulation::where('regulation_name', $regulationName)->value('id');
            return response()->json([
                "success" => false,
                "message" => "Data file kepabeanan is empty",
                "regulation_id" => $regulationId,
                "data" => []
            ], 200);
        }

        $dataRegulation = KepabeananRegulation::where('regulation_name', $regulationName)->first();

        return response()->json([
            "success" => true,
            "message" => "kepabeanan",
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
            $file->storeAs('file_kepabeanan', $file_name);

            $data = Kepabeanan::create([
                'title' => request('title'),
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
        $file = Kepabeanan::where('id', $id)->value('file');

        if (Storage::exists($file)) {
            // hapus file
            Storage::delete($file);

            // hapus data
            $kepabeanan = Kepabeanan::where('id', $id)->first();
            $kepabeanan->delete();
        } else {
            // hapus data
            $kepabeanan = Kepabeanan::where('id', $id)->first();
            $kepabeanan->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Data kepabeanan deleted',
        ]);
    }
}
