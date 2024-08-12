<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Http\Controllers\Controller;
use App\Models\OrganizationalStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrganizationalStructureController extends Controller
{
    public function getOrganizationImage()
    {
        $data = OrganizationalStructure::get();

        return response()->json([
            'success' => true,
            'message' => 'organizational_structure',
            'data' => $data,
        ]);
    }

    public function getOrganizationImageById($id)
    {
        
    }

    public function store_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,png,jpg,gif,svg|file|max:3048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $data_check = OrganizationalStructure::get()->count();
            if ($data_check >= 2) {
                return response()->json([
                    'message' => 'failed add data',
                    'data' => [],
                ], 422);
            } else {
                $image = $request->file('image');

                if ($image) { // Memastikan bahwa file gambar diunggah
                    $image_name = $image->getClientOriginalName();

                    $data = OrganizationalStructure::create([
                        'image' => $image->storeAs('organizational_structure', $image_name)
                    ]);

                    return response()->json([
                        'message' => 'organizational_structure image successfully added',
                        'data' => $data,
                    ]);
                } else {
                    return response()->json([
                        'message' => 'No image uploaded',
                        'data' => null,
                    ], 400);
                }
            }
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'failed',
                'errors' => $th->getMessage(),
            ], 400);
        }
    }

    public function delete_image($id)
    {
        $data_check = OrganizationalStructure::get()->count();

        if ($data_check > 1) {
            // hapus file
            $image = OrganizationalStructure::where('id', $id)->value('image');
            Storage::delete($image);

            // hapus data
            $data = OrganizationalStructure::where('id', $id)->first();
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data organization_structure deleted',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'failed delete data',
            ], 400);
        }
    }
}
