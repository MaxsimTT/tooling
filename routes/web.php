<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\DownloadFileController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [HomePageController::class, 'getHomePage'])->name('homePage');
Route::get('/', [HomePageController::class, 'getHomePage'])->name('homePage')->middleware('auth');
Route::post('/download', [DownloadFileController::class, 'setTool'])->name('downloadFile');
Route::get('/image_delete/{image_id}', [DownloadFileController::class, 'deleteImage'])->name('deleteFile');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
