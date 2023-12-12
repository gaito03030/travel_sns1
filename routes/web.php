<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\LogController;
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

Route::get('/test', [PostsController::class,'test']);

//一般ユーザ側　モデルコース一件表示
Route::get('/posts/{id}', [PostsController::class,'show'])->name('post');

//log出すようのページ
Route::get('/log',[LogController::class,'index'])->name('log');

//企業側　モデルコース作成画面
Route::get('/create/',[PostsController::class,'create'])->name('company_create_post');

Route::post('/create/post',[PostsController::class,'store'])->name('create.store');

Route::get('/create/edit/{id}',[PostsController::class,'edit'])->name('create.edit');
Route::post('/create/update',[PostsController::class,'update'])->name('create.update');

//company_mypageのためのルートを通す
Route::get('/company_mypage',[PostsController::class,'index']);

Route::get('posts',[PostsController::class,'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
