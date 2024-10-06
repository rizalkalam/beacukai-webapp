<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Client\SopController;
use App\Http\Controllers\Client\BerandaController;
use App\Http\Controllers\Client\LayananController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Client\PrestasiController;
use App\Http\Controllers\Client\StrukturController;
use App\Http\Controllers\Client\FaqClientController;
use App\Http\Controllers\Client\LayananUtamaController;
use App\Http\Controllers\Client\PenggunaJasaController;
use App\Http\Controllers\Client\IndeksKepuasanController;
use App\Http\Controllers\Client\PeraturanCukaiController;
use App\Http\Controllers\Dashboard\Beranda\FaqController;
use App\Http\Controllers\Dashboard\Beranda\PhotoController;
use App\Http\Controllers\Dashboard\Beranda\VideoController;
use App\Http\Controllers\Dashboard\Beranda\BannerController;
use App\Http\Controllers\Client\JanjiLayananClientController;
use App\Http\Controllers\Dashboard\Beranda\RevenueController;
use App\Http\Controllers\Dashboard\Beranda\ServiceController;
use App\Http\Controllers\Dashboard\Peraturan\CukaiController;
use App\Http\Controllers\Client\PeraturanKepabeananController;
use App\Http\Controllers\Dashboard\Beranda\FaqCategoryController;
use App\Http\Controllers\Dashboard\Layanan\MainServiceController;
use App\Http\Controllers\Dashboard\Profile\AchievementController;
use App\Http\Controllers\Dashboard\Profile\CertificateController;
use App\Http\Controllers\Dashboard\Profile\SopCategoryController;
use App\Http\Controllers\Dashboard\Profile\WorkingAreaController;
use App\Http\Controllers\Dashboard\Peraturan\KepabeananController;
use App\Http\Controllers\Dashboard\Profile\UserSatisfactionController;
use App\Http\Controllers\Dashboard\Peraturan\CukaiRegulationController;
use App\Http\Controllers\Dashboard\JanjiLayanan\ServicePromiseController;
use App\Http\Controllers\Dashboard\Peraturan\KepabeananRegulationController;
use App\Http\Controllers\Dashboard\Profile\OrganizationalStructureController;

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
// test
Route::get('/test', function () {
    return response()->json(['message' => 'Hello World']);
})->name('test');

// run migrate db after deploy
Route::get('/migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migration completed';
});

// salah token
Route::get('/wrongtoken', function () {
    return response()->json(['message' => 'Hello World']);
})->name('wrongtoken');

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
        Route::get('/photo/{id}', [PhotoController::class, 'getPhotoById']);
        Route::post('/photo', [PhotoController::class, 'store_photo']);
        Route::post('/photo/{id}', [PhotoController::class, 'update_photo']);
        Route::delete('/photo/{id}', [PhotoController::class, 'delete_photo']);

        // revenue
        Route::get('/revenue', [RevenueController::class, 'index']);
        Route::post('/revenue/change', [RevenueController::class, 'change']);

        // category
        Route::group(['prefix'=>'category'], function(){
            //faq category
            Route::get('/faq', [FaqCategoryController::class, 'getFaqCategory']);
            Route::get('/faq/{id}', [FaqCategoryController::class, 'getFaqCategoryById']);
            Route::post('/faq', [FaqCategoryController::class, 'create']);
            Route::post('/faq/{id}', [FaqCategoryController::class, 'update']);
            Route::delete('/faq/{id}', [FaqCategoryController::class, 'delete']);
        });

        // faq content
        Route::get('/faq', [FaqController::class, 'getByCategoryName']);
        Route::get('/faq/{id}', [FaqController::class, 'getFaqContentById']);
        Route::post('/faq', [FaqController::class, 'create']);
        Route::post('/faq/{id}', [FaqController::class, 'update']);
        Route::delete('/faq/{id}', [FaqController::class, 'delete']);

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
        Route::get('/cukai', [CukaiController::class, 'getByRegulationId']);
        Route::post('/cukai', [CukaiController::class, 'store']);
        Route::delete('/cukai/{id}', [CukaiController::class, 'delete']);

        // kepabeanan
        Route::get('/kepabeanan', [KepabeananController::class, 'getByRegulationId']);
        Route::post('/kepabeanan', [KepabeananController::class, 'store']);
        Route::delete('/kepabeanan/{id}', [KepabeananController::class, 'delete']);

        // wilayah kerja
        Route::get('/workingarea', [WorkingAreaController::class, 'getServiceUser']);
        Route::post('/workingarea/tobacco', [WorkingAreaController::class, 'changeTobacco']);
        Route::post('/workingarea/tpemmeaea', [WorkingAreaController::class, 'changeTpeMmeaEa']);
        Route::post('/workingarea/bondedstorageplace', [WorkingAreaController::class, 'changeBondedStoragePlace']);

        // sop
        Route::get('/sop', [SopCategoryController::class, 'index']);
        Route::get('/sop/{id}', [SopCategoryController::class, 'getSopById']);
        Route::post('/sop', [SopCategoryController::class, 'create']);
        Route::post('/sop/{id}', [SopCategoryController::class, 'update']);
        Route::delete('/sop/{id}', [SopCategoryController::class, 'delete']);

        // kepuasan pengguna
        Route::get('/satisfaction', [UserSatisfactionController::class, 'getUserSatisfaction']);
        Route::get('/satisfaction/{id}', [UserSatisfactionController::class, 'getUserSatisfactionById']);
        Route::post('/satisfaction', [UserSatisfactionController::class, 'create']);
        Route::post('/satisfaction/{id}', [UserSatisfactionController::class, 'update']);
        Route::delete('/satisfaction/{id}', [UserSatisfactionController::class, 'delete']);

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

        // service
        Route::get('/service', [ServiceController::class, 'getService']);
        Route::get('/service/{id}', [ServiceController::class, 'getServiceById']);
        Route::post('/service', [ServiceController::class, 'create']);
        Route::post('/service/{id}', [ServiceController::class, 'update']);
        Route::delete('/service/{id}', [ServiceController::class, 'delete']);

        // service promise
        Route::get('/servicepromise', [ServicePromiseController::class, 'getServicePromise']);
        Route::get('/servicepromise/{id}', [ServicePromiseController::class, 'getServicePromiseById']);
        Route::post('/servicepromise', [ServicePromiseController::class, 'create']);
        Route::post('/servicepromise/{id}', [ServicePromiseController::class, 'update']);
        Route::delete('/servicepromise/{id}', [ServicePromiseController::class, 'delete']);

        // organizational sturcture
        Route::get('/organizational', [OrganizationalStructureController::class, 'getOrganizationImage']);
        Route::post('/organizational', [OrganizationalStructureController::class, 'store_image']);
        Route::delete('/organizational/{id}', [OrganizationalStructureController::class, 'delete_image']);

        // main service
        Route::get('/main_service_category', [MainServiceController::class, 'getMainServiceCategory']);
        Route::get('/main_service', [MainServiceController::class, 'getMainServiceByCategory']);
        Route::post('/main_service', [MainServiceController::class, 'create']);
        Route::post('/main_service/{id}', [MainServiceController::class, 'update']);
        Route::delete('/main_service/{id}', [MainServiceController::class, 'delete']);
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});

// homepage
Route::get('/banners', [BerandaController::class, 'banners']);
Route::get('/videos', [BerandaController::class, 'videos']);
Route::get('/photos', [BerandaController::class, 'photos']);
Route::get('/photo/{id}', [BerandaController::class, 'photoById']);
Route::get('/revenue', [BerandaController::class, 'revenue']);

// faq
Route::get('/faq', [FaqClientController::class, 'getFaq']);

// peraturan cukai
Route::get('/peraturan/cukai', [PeraturanCukaiController::class, 'regulation']);
Route::get('/cukai', [PeraturanCukaiController::class, 'contentByRegulation']);
// peraturan kepabeanan
Route::get('/peraturan/kepabeanan', [PeraturanKepabeananController::class, 'regulation']);
Route::get('/kepabeanan', [PeraturanKepabeananController::class, 'contentByRegulation']);

// SOP
Route::get('/sop', [SopController::class, 'index']);

// prestasi dan apresiasi
Route::get('/achievements', [PrestasiController::class, 'achievement']);
Route::get('/certificates', [PrestasiController::class, 'certificate']);

// wilayah kerja
Route::get('/workingarea', [PenggunaJasaController::class, 'getWorkingArea']);

// janji layanan
Route::get('/servicepromise', [JanjiLayananClientController::class, 'getServicePromise']);

// index kepuasan
Route::get('/satisfaction', [IndeksKepuasanController::class, 'index']);

// struktur organisasi
Route::get('/struktur', [StrukturController::class, 'index']);

// layanan
Route::get('/service', [LayananController::class, 'index']);

// layanan utama
Route::get('/main_service_category', [LayananUtamaController::class, 'getMainServiceCategory']);
Route::get('/main_service', [LayananUtamaController::class, 'getMainServiceByCategory']);