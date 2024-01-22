<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store($postId,Request $request)
    {
        //comment投稿
        $comment = new Comment();

        $user = auth()->user();
        $user_id = $user->id;

        $comment->post_id = $postId;
        $comment->user_id = $user_id;
        $comment->detail = $request['detail'];

        $comment->save();

        /**コメントを通知*/
        //投稿のユーザを取得
        $post = Post::find($postId);
        $post_user_id = $post->user_id;
        
        $setting = Setting::where('user_id',$post_user_id)->first();

        $notice = new Notification();

        if ($user_id != $post_user_id) {
            //投稿主以外によるコメント
            if ($setting->notice_comment_flg) {
                //設定で許可している場合
                $notice->user_id = $post_user_id;
                $notice->type = 'コメント';
                $notice->body = 'モデルコースにコメントがつきました';
                $notice->url = '/reply/'.$postId.'/'.$comment->id;
                $notice->icon_url = $user->icon_url;

                $notice->save();
            }
        } 
        
        return redirect('general/posts/'.$postId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
