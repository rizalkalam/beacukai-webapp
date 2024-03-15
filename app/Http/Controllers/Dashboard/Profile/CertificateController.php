<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CertificateController extends Controller
{
    public function index()
    {
        $data = Certificate::get();

        return response()->json([
            'success' => true,
            'message' => 'List data Certificate',
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'mimes:jpeg,png,jpg,gif,svg|file|max:3048'
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
            $certificate_name = $file->getClientOriginalName();

            $data = Certificate::create([
                'file' => $file->storeAs('certificates', $certificate_name)
            ]);

            return response()->json([
                'message' => 'Store certificate success',
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

    public function delete_certificate($id)
    {
        // hapus file
        $file = Certificate::where('id', $id)->value('file');
        Storage::delete($file);

        // hapus data
        $certificate = Certificate::where('id', $id)->first();
        $certificate->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data certificate deleted',
        ]);
    }
}
