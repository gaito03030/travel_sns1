<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;




class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        
        $myPosts = Post::where('user_id', $id)->get();
        // dd($myPosts);

        //ログインしているユーザー名
        $userName = User::find($id)->name;
        
        return view('company_mypage', compact(['myPosts'],'userName'));
    }

    //投稿削除処理
    public function delete($id){
        $post = Post::find($id);
        return $post;


        //行を削除
        // $post->delete();

        // return redirect()->route('company_mypage');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //モデルコース一件取得

        $post = Post::with('user:id,name,icon_url', 'category', 'pref', 'details', 'spots')->find($id);

        if ($post->status !== 1) {
            //ステータスが公開中以外の場合はnot found を表示
            abort(404);
        }

        //return $post;
        return view('post', compact(['post']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // 検索機能の値取得とviewに値を返す
    public function search(Request $request)
    {

        //ログインしているユーザーの取得
        $id = auth()->user()->id;
        // dd($id);

        // 検索フォームから送信された検索語句を取得
        $searchTerm = $request->input('search');
        // dd($searchTerm);

        // ログインユーザーに関連する投稿を検索
        $myPosts = Post::where('user_id', $id)
            ->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            })->get();
        // dd($myPosts);

        //ログインしているユーザー名
        $userName = User::find($id)->name;
        return view('company_mypage', compact(['myPosts'],'userName'));
    }
}
