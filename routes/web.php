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
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\LikesController;
use App\Models\Notification;
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

Auth::routes();

/**ログインが必須な画面（ログイン状態でないと開けない。ログインしていない場合はログインページにリダイレクトされる） */
Route::group(['middleware' => ['auth']], function () {
    /**企業側 */
    //企業情報管理ページ
    Route::get('company/mypage', [UsersController::class, 'index'])->name('management_company');

    //企業側のhome
    Route::get('/company', [PostsController::class, 'index'])->name('company_mypage');

    //企業側のhomeの検索機能
    Route::get('/company/search', [PostsController::class, 'search'])->name('company_mypage.posts');

    //POSTを削除をする画面
    Route::get('company/delete/{id}', [PostsController::class, 'delete_page'])->name('company_mypage.delete');
    //POSTを削除する処理
    Route::get('company/delete/exe/{id}', [PostsController::class, 'delete_exe'])->name('company_mypage.delete.exe');

    //企業側　モデルコース作成画面
    Route::get('company/create/', [PostsController::class, 'create'])->name('company_create_post');

    Route::post('/create/post', [PostsController::class, 'store'])->name('create.store');

    Route::get('company/create/edit/{id}', [PostsController::class, 'edit'])->name('create.edit');
    Route::post('/create/update', [PostsController::class, 'update'])->name('create.update');

    //企業情報編集画面にルートを通す
    Route::get('/company/mypage/edit', [UsersController::class, 'show'])->name('user_edit');

    //通知
    Route::get('company/notification', [NotificationsController::class, 'index'])->name('notification');
    Route::get('company/notification/setting', [NotificationsController::class, 'edit']);
    Route::post('/notification/setting/update', [NotificationsController::class, 'update'])->name('notification.update');

    /**一般側 */
    // 一般ユーザーのマイページ
    Route::get('/general/mypage', [UsersController::class, 'general_mypage'])->name('userpage');
    //一般ユーザーの編集画面
    Route::get('/general/mypage/edit', [UsersController::class, 'prof_edit'])->name('general.mypage.edit');

    //投稿コメント返信ページ
    Route::post('/comment/{postId}', [CommentsController::class, 'store'])->name('comment.store');
    Route::get('/reply/{postId}/{commentId}', [RepliesController::class, 'create'])->name('reply.create');
    Route::post('/reply/store', [RepliesController::class, 'store'])->name('reply.store');
});

/**兼用 */
//log出すようのページ
Route::get('/log', [LogController::class, 'index'])->name('log');

/**一般側(ログインなしで表示可能) */
//timeline
Route::get('/', [PostsController::class, 'post_timeline'])->name('timeline');

//一般ユーザ側　モデルコース一件表示
Route::get('/general/posts/{id}', [PostsController::class, 'show'])->name('post');

//一般ユーザ側　検索
Route::get('/general/search', [PostsController::class, 'post_search_show'])->name('post_search_show');
Route::get('/general/search/result', [PostsController::class, 'post_search_result'])->name('post_search_result');

// 投稿画面からユーザ情報
//Route::get('/general/user/{id}', [UsersController::class, 'user_info'])->name('user_info');
Route::get('/general/user/{id}', [UsersController::class, 'userside_comp_prof'])->name('general.user');


// 投稿の編集保存
// Route::put('/user_edit/store',[UsersController::class,'store']);
Route::put('/user_edit/store/{id}', [UsersController::class, 'store'])->name('user_edit.store');

//画像アップロード
Route::put('/user_edit/img/{id}', [UsersController::class, 'uploadImg'])->name('user_edit.img');

//ブックマーク機能
Route::post('/posts/{post}/bookmark', [BookmarksController::class, 'store'])->name('bookmark.store');
Route::delete('/posts/{post}/unbookmark', [BookmarksController::class, 'destroy'])->name('bookmark.destroy');
Route::get('/bookmarks', [BookmarksController::class, 'bookmark_posts'])->name('bookmarks');

// いいね機能
Route::post('/posts/{post}/like', [LikesController::class, 'store'])->name('like.store');
Route::delete('/posts/{post}/unlike', [LikesController::class, 'destroy'])->name('like.destroy');

//一般ユーザの登録
// 企業ユーザー登録
// Route::get('register/company', 'Auth\RegisterController@showCompanyRegistrationForm')->name('register.company');
// Auth::routes(['register_company' => true]);
Route::get('register/company', [App\Http\Controllers\Auth\RegisterController::class, 'show'])->name('register.company');
Route::post('register/info', [App\Http\Controllers\Auth\RegisterController::class, 'showCompanyRegistrationForm'])->name('register.info.post');
Route::get('register/jojo', [App\Http\Controllers\Auth\RegisterController::class, 'redirectPath'])->name('register.jojo');
// Route::post('register/company', 'Auth\RegisterController@register')->name('register.company.post');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('posts', [PostsController::class, 'index']);


//ログイン機能/ログアウト機能
// Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/login/branch', [UsersController::class, 'branch'])->name('login.branch');

//テスト:一般ユーザー ＞投稿画面＞アイコンクリック＞投稿した企業を表示
Route::get('test_show/{user_id}', [FollowsController::class, 'index'])->name('test_show');

//テスト:企業＞フォローする
Route::get('test_follow/{id}', [FollowsController::class, 'follow'])->name('test_follow');

//フォローリスト一覧
Route::get('follow_list', [FollowsController::class, 'showFollowedCompanies'])->name('follow_list');
