<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Notification;

class FollowsController extends Controller
{
    //
    public function index($user_id)
    {

        //クリックした企業の情報を取得
        $company_info = User::find($user_id);

        //  return $company_info;
        return view('user_follow', compact(['company_info']));
    }

    public function follow($id)
    {

        //ログインしているユーザーを取得
        $login_user = auth()->user();
        $login_user_id = $login_user->id;

        // すでにフォローしているか確認
        $isFollowing = Follow::where('user_id', $login_user_id)
            ->where('followed_user_id', $id)
            ->exists();

        if (!$isFollowing) {
            // フォローしていなければ新しくレコードを作成
            Follow::create([
                'user_id' => $login_user_id,
                'followed_user_id' => $id,
            ]);

            /**通知*/

            $setting = Setting::where('user_id', $id)->first();

            $notice = new Notification();

            if ($login_user_id != $id) {
                //投稿主以外によるコメント
                if ($setting->notice_comment_flg) {
                    //設定で許可している場合
                    $notice->user_id = $id;
                    $notice->type = 'コメント';
                    $notice->body = $login_user->name . '&nbsp;さんからフォローされました';
                    $notice->url = '/follower';
                    $notice->icon_url = $login_user->icon_url;

                    $notice->save();
                }
            }
        }

        return redirect()->route('general.user',['id' => $id]);
    }

    //フォローを外す
    public function follow_remove($id){
        //ログインしているユーザ
        $login_user = auth()->user()->id;
        //フォローしている企業の$id
        $company_id = $id;

        Follow::where('user_id',$login_user)
                ->where('followed_user_id',$company_id)
                ->delete();

        return redirect()->route('follow_list');
    }

    //フォローしている企業一覧表
    public function showFollowedCompanies()
    {
        // ログインしているユーザーを取得
        $user = auth()->user();

        // フォローしている企業の一覧を取得
        $followedCompanies = $user->followedCompanies;

        return view('follow_list', compact('followedCompanies'));
    }
}
