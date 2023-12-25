<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reply;
use App\Models\Post;
use App\Models\Notification;
use App\Models\Setting;
use Illuminate\Http\Request;
use PHPUnit\Framework\Error\Notice;

class RepliesController extends Controller
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
    public function create($postId, $commentId)
    {
        $post_id = $postId;
        $comment_id = $commentId;

        return view('reply', compact('comment_id', 'post_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reply = new Reply();

        $user = auth()->user();
        $user_id = $user->id;

        $reply->comment_id = $request['comment_id'];
        $reply->user_id = $user_id;
        $reply->detail = $request['detail'];

        $reply->save();

        //コメント主へ返信を通知
        $post_id = $request['post_id'];
        $comment_user_id = Comment::find($request['comment_id'])->user_id;

        $notice = new Notification();
        $setting = Setting::where('user_id', $user_id)->first();

        if ($user_id == $comment_user_id) {
            //投稿主による返信
            if ($setting->notice_poster_reply_flg) {
                //設定で許可している場合
                $notice->user_id = $comment_user_id;
                $notice->type = '返信';
                $notice->body = 'コメントに投稿主による返信がつきました';
                $notice->url = '/posts/'.$post_id;
                $notice->icon_url = $user->icon_url;

                $notice->save();
            }
        } else {
            //投稿主以外による返信
            if ($setting->notice_reply_flg) {
                //設定で許可している場合
                $notice->user_id = $comment_user_id;
                $notice->type = '返信';
                $notice->body = 'コメントに&nbsp;'.$user->name.'&nbsp;さんから返信がつきました';
                $notice->url = '/posts/'.$post_id;
                $notice->icon_url = $user->icon_url;

                $notice->save();
            }
        }


        return redirect('/posts/' . $post_id);
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
