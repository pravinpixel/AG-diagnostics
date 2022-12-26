<?php

use App\Http\Controllers\Website\BannerController;
use App\Http\Controllers\Website\SampleCollectionCenterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\BrochureController;
use App\Http\Controllers\Website\CareersController;
use App\Http\Controllers\Website\CityController;
use App\Http\Controllers\Website\ContactController;
use App\Http\Controllers\Website\CurrentOpeningController;
use App\Http\Controllers\Website\HomeVisitAreaController;
use App\Http\Controllers\Website\PackagesController;
use App\Http\Controllers\Website\HomeVisitController;
use App\Http\Controllers\Website\MediaController;
use App\Http\Controllers\Website\NewsEventController;
use App\Http\Controllers\Website\TestController;
use App\Http\Controllers\Website\TestimonialController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/brochure', [BrochureController::class, 'index'])->name('brochure');

Route::get('/selected-packages', [PackagesController::class, 'selectedPackages'])->name('selected-packages');
Route::post('/packages', [PackagesController::class, 'index'])->name('packages');
Route::post('/package', [PackagesController::class, 'store'])->name('package');
Route::get('/package-detail/{id}', [PackagesController::class, 'packageDetails'])->name('package-detail');
Route::get('/test', [TestController::class, 'index'])->name('test');
Route::post('/find-a-lab', [SampleCollectionCenterController::class, 'index'])->name('find-a-lab');
// Route::post('/find-lab-filter', [SampleCollectionCenterController::class, 'findLabFilter'])->name('find-lab-filter');


Route::get('/home-visit-area', [HomeVisitAreaController::class, 'index'])->name('home-visit-area');
Route::get('/city', [CityController::class, 'index'])->name('city');
Route::get('/current-opening', [CurrentOpeningController::class,'index'])->name('current-opening');

Route::post('/home-visit', [HomeVisitController::class, 'store'])->name('home-visit');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact-us');
Route::get('/job-details/{id}', [CareersController::class, 'getJobDetail'])->name('job-details');

Route::post('/job-apply', [CareersController::class, 'jobApply'])->name('job-apply');
Route::get('/testimonial', [TestimonialController::class,'index'])->name('testimonial');
Route::get('/banner', [BannerController::class,'index'])->name('banner');
Route::get('/media', [MediaController::class,'index'])->name('media');
Route::get('/media/{id}', [MediaController::class,'mediaDetail'])->name('mediaDetail');

Route::post('/news-event', [NewsEventController::class,'index'])->name('news-event');
Route::get('/news-event/{id}', [NewsEventController::class,'newsDetail'])->name('newsDetail');






