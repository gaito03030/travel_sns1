<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use App\Models\Post;

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

Route::get('/', function () {
    return view('welcome');
});
<<<<<<< HEAD
Route::get('/test', [PostsController::class,'index']);
=======
//Route::get('/test', [PostsController::class,'index']);

//一般ユーザ側　モデルコース一件表示
Route::get('/posts/{id}', [PostsController::class,'show'])->name('post');

//company_mypageのためのルートを通す
Route::get('/company_mypage',[PostsController::class,'index']);


Route::get('posts',[PostsController::class,'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
>>>>>>> 54df9c4c8cdfc5978930405145d5cfe00bf649d9

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
