<?php
include 'auth.php';
include 'admin.php';
include 'api.php';
// include 'website.php';

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Admin\HomeVisitAreaController;
use App\Http\Controllers\Admin\TestimonialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function() {
//     return redirect('/login');
// }); 

// Route::group([ 'middleware' => ['auth_users']], function () {
Route::middleware(['auth_users'])->group(function () {
    Route::get('home-visit-area', [HomeVisitAreaController::class, 'index'])->name('home-visit-area.index');
    Route::get('testimonial', [TestimonialController::class, 'index'])->name('testimonial.index');
    
    // \UniSharp\LaravelFilemanager\Lfm::routes();
});