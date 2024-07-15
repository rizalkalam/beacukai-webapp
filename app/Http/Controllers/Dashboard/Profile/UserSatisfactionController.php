<?php

namespace App\Http\Controllers\Dashboard\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\UserSatisfaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserSatisfactionController extends Controller
{
    public function getUserSatisfaction()
    {
        $data = UserSatisfaction::get();

        return response()->json([
            "success" => true,
            "message" => "Indeks Kepuasan Pengguna",
            "data" => $data,
        ], 200);
    }

    public function getUserSatisfactionById($id)
    {
        $data = UserSatisfaction::where('id', $id)->first();

        return response()->json([
            "success" => true,
            "message" => "Indeks Kepuasan Pengguna By id",
            "data" => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'value' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            // Mendapatkan tahun dari tanggal yang diberikan
            $givenDate = Carbon::parse($request->input('date'));
            $givenYear = $givenDate->year;

            // Memeriksa apakah ada data untuk tahun yang diberikan
            $yearCheck = UserSatisfaction::whereYear('date', $givenYear)->exists();
            if (!$yearCheck) {
                $data = UserSatisfaction::create([
                    'date' => request('date'),
                    'value' => request('value')
                ]);

                return response()->json([
                    'message' => 'Data success created',
                    'data' => $data,
                ]);
            } else {
                return response()->json([
                    'message' => 'failed',
                    'errors' => 'available this year',
                ], 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'failed',
                'errors' => $th->getMessage(),
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'value' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        try {
            $data = UserSatisfaction::where('id', $id)
            ->first();
            
            // Mendapatkan tahun dari tanggal yang diberikan
            $givenDate = Carbon::parse($request->input('date'));
            $givenYear = $givenDate->year;

            // Memeriksa apakah ada data lain dengan tahun yang sama kecuali data yang sedang di-update
            $yearCheck = UserSatisfaction::whereYear('date', $givenYear)
                        ->where('id', '!=', $id)
                        ->exists();

            if (!$yearCheck) {
                // Mengupdate data jika tidak ada data lain dengan tahun yang sama
                $data->update([
                    'date' => $request->input('date'),
                    'value' => $request->input('value')
                ]);

                return response()->json([
                    'message' => 'Data successfully updated',
                    'data' => $data,
                ]);
            } else {
                // Mengembalikan respon error jika data lain dengan tahun yang sama sudah ada
                return response()->json([
                    'message' => 'Failed',
                    'errors' => 'Data for this year already exists',
                ], 400);
            }
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
        $data = UserSatisfaction::where('id', $id)->first();

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data success deleted',
        ]);
    }
}
