<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\LoginController;
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

//management_companyにルートを通す
Route::get('management_company',[UsersController::class,'index'])->name('management_company');

//一般ユーザ側　モデルコース一件表示
Route::get('/posts/{id}', [PostsController::class,'show'])->name('post');

//company_mypageのためのルートを通す
Route::get('/company_mypage',[PostsController::class,'index'])->name('company_mypage');

//company_mypageの検査機能
Route::get('/company_mypage/posts', [PostsController::class, 'search'])->name('company_mypage.posts');

//company_mypage.delete削除処理
Route::delete('company_mypage/delete/{id}',[PostsController::class,'delete'])->name('company_mypage.delete');

//user_editにルートを通す
Route::get('/user_edit',[UsersController::class,'show'])->name('user_edit');  

//user_editからputされる
// Route::put('/user_edit/store',[UsersController::class,'store']);
Route::put('/user_edit/store/{id}', [UsersController::class, 'store'])->name('user_edit.store');

//user_eidtから画像のルート
Route::put('/user_edit/img/{id}',[UsersController::class,'uploadImg'])->name('user_edit.img');

Route::get('posts',[PostsController::class,'index']);
 

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ログアウト機能
// Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class,'logout']);