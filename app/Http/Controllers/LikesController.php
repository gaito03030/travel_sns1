<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Notification;

class LikesController extends Controller
{
    public function store($post_id)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if (!$user->is_like($post_id)) {
            $user->like_posts()->attach($post_id);
        }

        /**コメントを通知*/
        //投稿のユーザを取得
        $post = Post::find($post_id);
        $post_user_id = $post->user_id;

        $setting = Setting::where('user_id', $post_user_id)->first();

        $notice = new Notification();

        if ($user_id != $post_user_id) {
            //投稿主以外によるコメント
            if ($setting->notice_comment_flg) {
                //設定で許可している場合
                $notice->user_id = $post_user_id;
                $notice->type = 'コメント';
                $notice->body = 'モデルコースにいいねがつきました';
                $notice->url = '/posts/' . $post_id;
                $notice->icon_url = $user->icon_url;

                $notice->save();
            }
        }

        return back();
    }

    public function destroy($post_id)
    {
        $user = User::find(auth()->user()->id);
        if ($user->is_like($post_id)) {
            $user->like_posts()->detach($post_id);
        }
        return back();
    }
}
