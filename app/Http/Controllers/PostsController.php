<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Auth;
use App\Models\Detail;
use App\Models\Spot;

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
        return view('company_create_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input_data = $request->except('action');

        // ログインしているユーザーの情報を取得
        $user_id = auth()->user();

        $post_data = new Post;

        //公開非公開のチェックボックスを受け取る

        $post_data->fill(
            [
                'user_id' => $user_id->id,
                'category_id' => '1',
                'title' => $input_data['title'],
                'main_img_url' => 'default.jpg',
                'status' => $input_data['status'],
                'pref_id' => '1',
                'description' => $input_data['description']
            ]
        );

        $post_data->save();

        //保存した投稿のIDを取得
        $post_id = $post_data->id;

        /**
         * 詳細テーブルに保存
         */
        if (isset($input_data['detail_title'])) {

            for ($i = 0; $i < count($input_data['detail_title']); $i++) {
                $post_detail = new Detail;

                $post_detail->post_id = $post_id;
                $post_detail->title = $input_data['detail_title'][$i];
                $post_detail->content = $input_data['detail_content'][$i];

                $post_detail->save();
            }
        }

        /**
         * スポットてーぶるにルート保存
         */

        for ($i = 0; $i < $input_data['date_length']; $i++) {
            for ($l = 0; $l < count($input_data['spot_title_'.($i + 1)]); $l++) {

                $post_spot = new Spot;

                $post_spot->post_id = $post_id;
                $post_spot->title = $input_data['spot_title_'.($i + 1)][$l];
                $post_spot->description = $input_data['spot_description_'.($i + 1)][$l];
                $post_spot->date = $i + 1;
                $post_spot->time = $input_data['spot_time_'.($i + 1)][$l];
                $post_spot->address = $input_data['spot_address_'.($i + 1)][$l];
                $post_spot->icon = "icon_default.png";

                $post_spot->save();
            }
        }

        return redirect('/log')->with('alert', '保存しました');
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
        $post = Post::with('user:id,name,icon_url', 'category', 'pref', 'details', 'spots')->find($id);

        return $post;
        //return view('post_edit', compact('post'));
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
        /*

        //更新処理
        $user_id = auth()->user()->id;
        $post = Post::find($id);

        $post->user_id = $user_id;
        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->category_id = $request['category_id'];
        $post->status = $request['status'];
        $post->main_img_url = "default.jpg";
        $post->pref_id = '1';

        /*
        $image = $request->file('image');
        $path = Storage::disk('s3')->putFile('bgama32070', $image, 'public');
        $post->image_path = Storage::disk('s3')->url($path);
        */
/*
        $post->save();
    
        */

        return redirect('/log')->with('alert', '更新しました');
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
