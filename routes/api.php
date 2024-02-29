<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\Beranda\PhotoController;
use App\Http\Controllers\Dashboard\Beranda\VideoController;
use App\Http\Controllers\Dashboard\Beranda\BannerController;
use App\Http\Controllers\Dashboard\Beranda\RevenueController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// salah token
Route::get('/wrongtoken', [AuthController::class, 'wrongtoken'])->name('wrongtoken');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::group(["prefix"=>"admin"], function(){

        // banner
        Route::get('/banner', [BannerController::class, 'index']);
        Route::post('/banner', [BannerController::class, 'store_banner']);
        Route::delete('/banner/{id}', [BannerController::class, 'delete_banner']);

        // galeri video
        Route::get('/video', [VideoController::class, 'index']);
        Route::get('/video/{id}', [VideoController::class, 'video_id']);
        Route::post('/video', [VideoController::class, 'store_video']);
        Route::post('/video/{id}', [VideoController::class, 'update_video']);
        Route::delete('/video/{id}', [VideoController::class, 'delete_video']);

        // photo
        Route::get('/photo', [PhotoController::class, 'index']);
        Route::post('/photo', [PhotoController::class, 'store_photo']);
        Route::delete('/photo/{id}', [PhotoController::class, 'delete_photo']);

        // revenue
        Route::get('/revenue', [RevenueController::class, 'index']);
        Route::post('/revenue/change', [RevenueController::class, 'change']);
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});