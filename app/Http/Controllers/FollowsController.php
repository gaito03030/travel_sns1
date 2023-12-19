<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;

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
        $login_user_id = auth()->user()->id;

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
        }

        return redirect()->name('test_follow');
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
