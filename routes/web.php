<?php
include 'auth.php';
include 'admin.php';
include 'api.php';
// include 'website.php';

use Illuminate\Support\Facades\Route; 
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


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth_users']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});