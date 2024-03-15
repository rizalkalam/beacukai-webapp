<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\SopController;
use App\Http\Controllers\Client\BerandaController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Client\PrestasiController;
use App\Http\Controllers\Client\PeraturanCukaiController;
use App\Http\Controllers\Dashboard\Beranda\PhotoController;
use App\Http\Controllers\Dashboard\Beranda\VideoController;
use App\Http\Controllers\Dashboard\Beranda\BannerController;
use App\Http\Controllers\Dashboard\Beranda\RevenueController;
use App\Http\Controllers\Dashboard\Peraturan\CukaiController;
use App\Http\Controllers\Client\PeraturanKepabeananController;
use App\Http\Controllers\Dashboard\Profile\AchievementController;
use App\Http\Controllers\Dashboard\Profile\CertificateController;
use App\Http\Controllers\Dashboard\Profile\SopCategoryController;
use App\Http\Controllers\Dashboard\Peraturan\KepabeananController;
use App\Http\Controllers\Dashboard\Peraturan\CukaiRegulationController;
use App\Http\Controllers\Dashboard\Peraturan\KepabeananRegulationController;

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

        //regulation
        Route::group(['prefix'=>'regulation'], function(){
            // cukai
            Route::get('/cukai', [CukaiRegulationController::class, 'index']);
            Route::get('/cukai/{regulation_id}', [CukaiRegulationController::class, 'getRegulationById']);
            Route::post('/cukai', [CukaiRegulationController::class, 'create']);
            Route::post('/cukai/{regulation_id}', [CukaiRegulationController::class, 'update']);
            Route::delete('/cukai/{regulation_id}', [CukaiRegulationController::class, 'delete']);

            // kepabeanan
            Route::get('/kepabeanan', [KepabeananRegulationController::class, 'index']);
            Route::get('/kepabeanan/{regulation_id}', [KepabeananRegulationController::class, 'getRegulationById']);
            Route::post('/kepabeanan', [KepabeananRegulationController::class, 'create']);
            Route::post('/kepabeanan/{regulation_id}', [KepabeananRegulationController::class, 'update']);
            Route::delete('/kepabeanan/{regulation_id}', [KepabeananRegulationController::class, 'delete']);
        });

        // cukai
        Route::get('/cukai/{id}', [CukaiController::class, 'getByRegulationId']);
        Route::post('/cukai', [CukaiController::class, 'store']);
        Route::delete('/cukai/{id}', [CukaiController::class, 'delete']);

        // kepabeanan
        Route::get('/kepabeanan/{id}', [KepabeananController::class, 'getByRegulationId']);
        Route::post('/kepabeanan', [KepabeananController::class, 'store']);
        Route::delete('/kepabeanan/{id}', [KepabeananController::class, 'delete']);

        // sop
        Route::get('/sop', [SopCategoryController::class, 'index']);
        Route::get('/sop/{id}', [SopCategoryController::class, 'getSopById']);
        Route::post('/sop', [SopCategoryController::class, 'create']);
        Route::post('/sop/{id}', [SopCategoryController::class, 'update']);
        Route::delete('/sop/{id}', [SopCategoryController::class, 'delete']);

        // achievement
        Route::get('/achievement', [AchievementController::class, 'getAchievement']);
        Route::get('/achievement/{id}', [AchievementController::class, 'getAchievementById']);
        Route::post('/achievement', [AchievementController::class, 'create']);
        Route::post('/achievement/{id}', [AchievementController::class, 'edit']);
        Route::delete('/achievement/{id}', [AchievementController::class, 'delete']);
        // certificate
        Route::get('/certificate', [CertificateController::class, 'index']);
        Route::post('/certificate', [CertificateController::class, 'store']);
        Route::delete('/certificate/{id}', [CertificateController::class, 'delete_certificate']);
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});

// homepage
Route::get('/banners', [BerandaController::class, 'banners']);
Route::get('/videos', [BerandaController::class, 'videos']);
Route::get('/photos', [BerandaController::class, 'photos']);
Route::get('/revenue', [BerandaController::class, 'revenue']);

// peraturan cukai
Route::get('/peraturan/cukai', [PeraturanCukaiController::class, 'regulation']);
Route::get('/cukai/{id}', [PeraturanCukaiController::class, 'contentByRegulation']);
// peraturan kepabeanan
Route::get('/peraturan/kepabeanan', [PeraturanKepabeananController::class, 'regulation']);
Route::get('/kepabeanan/{id}', [PeraturanKepabeananController::class, 'contentByRegulation']);

// SOP
Route::get('/sop', [SopController::class, 'index']);

// prestasi dan apresiasi
Route::get('/achievements', [PrestasiController::class, 'achievement']);
Route::get('/certificates', [PrestasiController::class, 'certificate']);