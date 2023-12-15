<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Auth;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Detail;
use App\Models\Spot;
use App\Models\Pref;

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

        $myPosts = Post::where('user_id', $id)->get();
        // dd($myPosts);

        //ログインしているユーザー名
        $userName = User::find($id)->name;

        return view('company_mypage', compact(['myPosts'], 'userName'));
    }

    //投稿削除処理
    public function delete($id)
    {
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
        $category = Category::all();
        $pref = Pref::all();

        $datas = [
            'category' => $category,
            'pref' => $pref
        ];

        //return $datas;
        return view('company_create_post', compact('datas'));
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

        //画像のアップロード
        // ディレクトリ名
        $dir = 'post';
        $path = "";

        if (isset($request['main_image'])) {

            // アップロードされたファイル名を取得
            $file_name = $request->file('main_image')->getClientOriginalName();

            // 取得したファイル名で保存
            $request->file('main_image')->storeAs('public/' . $dir, $file_name);

            $path = 'storage/' . $dir . '/' . $file_name;
        } else {
            //画像が設定されていない場合はデフォルト画像
            $path = 'storage/' . $dir . '/default.jpg';
        }
        // ログインしているユーザーの情報を取得
        $user_id = auth()->user();

        $post_data = new Post;

        $post_data->fill(
            [
                'user_id' => $user_id->id,
                'category_id' => $input_data['category'],
                'title' => $input_data['title'],
                'main_img_url' => $path,
                'status' => $input_data['status'],
                'pref_id' => $input_data['pref'],
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
            for ($l = 0; $l < count($input_data['spot_title_' . ($i + 1)]); $l++) {

                $post_spot = new Spot;

                $post_spot->post_id = $post_id;
                $post_spot->title = $input_data['spot_title_' . ($i + 1)][$l];
                $post_spot->description = $input_data['spot_description_' . ($i + 1)][$l];
                $post_spot->date = $i + 1;
                $post_spot->time = $input_data['spot_time_' . ($i + 1)][$l];
                $post_spot->address = $input_data['spot_address_' . ($i + 1)][$l];
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
        $comments = Comment::with('user:id,name,icon_url','replies')->where('post_id',$id)->get();

        if ($post->status !== 1) {
            //ステータスが公開中以外の場合はnot found を表示
            abort(404);
        }

        $data = [
            'post'=>$post,
            'comments'=> $comments
        ];

        //return $data;
        return view('post', compact(['data']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $post = Post::with('user:id,name,icon_url', 'category', 'pref', 'details')->find($id);

        if ($post->user_id !== auth()->user()->id) {
            //ステータスが公開中以外の場合はnot found を表示
            abort(404);
        }


        //spotをdateごとにグループ化
        $spots = Spot::orderBy('date', 'asc')->where('post_id', $id)->get();
        $spots = $spots->groupBy('date')->toArray();

        $category = Category::all();
        $pref = Pref::all();

        $datas = [
            'post' => $post,
            'spots' => $spots,
            'category' => $category,
            'pref' => $pref
        ];


        //return $datas;
        return view('post_edit', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //更新処理
        $user_id = auth()->user()->id;
        $post = Post::find($request['post_id']);

        if ($user_id == $post['user_id']) {
            $post->user_id = $user_id;
            $post->title = $request['title'];
            $post->description = $request['description'];
            $post->category_id = $request['category'];
            $post->status = $request['status'];
            $post->main_img_url = "default.jpg";
            $post->pref_id = '1';

            //details更新
            //もともとのdetails を取得しておく
            $old_details = Detail::where('post_id', $request['post_id'])->get();

            if (isset($request['detail_title'])) {

                for ($i = 0; $i < count($request['detail_title']); $i++) {
                    $post_detail = new Detail;

                    $post_detail->post_id = $request['post_id'];
                    $post_detail->title = $request['detail_title'][$i];
                    $post_detail->content = $request['detail_content'][$i];

                    $post_detail->save();
                }
            }

            //古いdetailsを削除
            foreach ($old_details as $old_detail) {
                $old_detail->delete();
            }

            //spot更新

            //古いspotを取得
            $old_spots = Spot::where('post_id', $request['post_id'])->get();

            //requestから新しいスポットを登録
            for ($i = 0; $i < $request['date_length']; $i++) {
                for ($l = 0; $l < count($request['spot_title_' . ($i + 1)]); $l++) {

                    $post_spot = new Spot;

                    $post_spot->post_id = $request['post_id'];
                    $post_spot->title = $request['spot_title_' . ($i + 1)][$l];
                    $post_spot->description = $request['spot_description_' . ($i + 1)][$l];
                    $post_spot->date = $i + 1;
                    $post_spot->time = $request['spot_time_' . ($i + 1)][$l];
                    $post_spot->address = $request['spot_address_' . ($i + 1)][$l];
                    $post_spot->icon = "icon_default.png";

                    $post_spot->save();
                }
            }

            //古いspotsを削除
            foreach ($old_spots as $old_spot) {
                $old_spot->delete();
            }

            //保存
            $post->save();

            return redirect('/log')->with('alert', '更新しました');
        } else {
            return redirect('/log')->with('alert', '投稿したユーザ以外が更新することはできません');
        }
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
        return view('company_mypage', compact(['myPosts'], 'userName'));
    }
}
