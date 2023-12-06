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
        // $return =  Post::all();
        // return view('test',compact('return'));


            // // ログインしているユーザーの情報を取得
            // $user = auth()->user();

            // // ログインしているユーザーの投稿を取得
            // $userPosts = $user->posts;
    
            // return view('company_mypage', compact('userPosts'));

            // すべての投稿を取得
        $allPosts = Post::all();
        $id = auth()->user()->id;
        $myPosts = User::with('posts')->find($id);
        // return $myPosts;
        return view('company_mypage', compact(['myPosts']));
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

        $post = Post::with('user:id,name,icon_url','category','pref','details','spots')->find($id);

        if($post->status !== 1){
            //ステータスが公開中以外の場合はnot found を表示
            abort(404);
        }

        //return $post;
        return view('post',compact(['post']));
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
}
