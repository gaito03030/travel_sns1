<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\BookmarksController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Post;
use App\Models\Reply;

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

//企業情報管理ページにルートを通す
Route::get('management_company',[UsersController::class,'index'])->name('management_company');
Route::get('/test', [PostsController::class,'test']);

//timeline
Route::get('/timeline',[PostsController::class,'post_timeline']);

//一般ユーザ側　モデルコース一件表示
Route::get('/posts/{id}', [PostsController::class,'show'])->name('post');

//一般ユーザ側　検索
Route::get('/search',[PostsController::class,'post_search_show'])->name('post_search_show');
Route::get('/search/result',[PostsController::class,'post_search_result'])->name('post_search_result');
// 一般ユーザー側から見た企業ページ
Route::get('/userpage',[UsersController::class,'userside_comp_prof']);

//log出すようのページ
Route::get('/log',[LogController::class,'index'])->name('log');

//企業側　モデルコース作成画面
Route::get('/create/',[PostsController::class,'create'])->name('company_create_post');

Route::post('/create/post',[PostsController::class,'store'])->name('create.store');

Route::get('/create/edit/{id}',[PostsController::class,'edit'])->name('create.edit');
Route::post('/create/update',[PostsController::class,'update'])->name('create.update');

//投稿コメント返信ページ
Route::post('/comment/{postId}',[CommentsController::class,'store'])->name('comment.store');
Route::get('/reply/{postId}/{commentId}',[RepliesController::class,'create'])->name('reply.create');
Route::post('/reply/store',[RepliesController::class,'store'])->name('reply.store');

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
 
//ブックマーク機能
Route::post('/posts/{post}/bookmark', [BookmarksController::class, 'store'])->name('bookmark.store');
Route::delete('/posts/{post}/unbookmark', [BookmarksController::class, 'destroy'])->name('bookmark.destroy');
Route::get('/bookmarks', [BookmarksController::class, 'bookmark_posts'])->name('bookmarks');

Route::get('/notification',[NotificationsController::class,'index'])->name('notification');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('posts',[PostsController::class,'index']);


//ログアウト機能
// Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class,'logout']);

