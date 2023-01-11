<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\MyAuthController;

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
Route::get('/', [HomePageController::class, 'getHomePage'])->name('homePage')/*->middleware('auth')*/;
Route::post('/download', [DownloadFileController::class, 'setTool'])->name('downloadFile');
Route::get('/image_delete/{image_id}', [DownloadFileController::class, 'deleteImage'])->name('deleteFile');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function() {
	Route::get('/', [AdminHomeController::class, 'show'])->name('admin_home');
	Route::get('/add/post', [AdminPostController::class, 'create'])->name('admin_add_post');

	Route::get('/posts/create', [PostController::class, 'create'])->name('create_post');
	Route::post('/posts', [PostController::class, 'store']);

	Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('show_post');
	Route::match(['patch', 'put'], '/posts/{post}', [PostController::class, 'update']);
});

Route::get('/login', [MyAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [MyAuthController::class, 'authenticateLogin']);
