<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;

class UsersController extends Controller
{
    //

    public function index()
    {
        //ログインしているユーザーを取得
        $id = auth()->user()->id;
        //user情報を取得
        $user_info = User::withCount('follower_users')->find($id);
        //userの投稿の件数を取得
        $posts_number = Post::where('user_id', $id)->where('status', 1)->count();

        $user_bookmarks = User::find($id)->bookmark_total();

        // dd($posts_number);
        return view('management_company', compact(['user_info', 'posts_number', 'user_bookmarks']));
    }

    public function show()
    {

        //ログインしているユーザーを取得
        $id = auth()->user()->id;
        //user情報を取得
        $user_info = User::find($id);


        return view('user_edit', compact(['user_info']));
    }

    public function store(Request $request, $id)
    {

        $user = User::find($id);

        // 画像フォームでリクエストした画像情報を取得
        $up_img = $request->file('img_path');
        if (!empty($up_img)) {

            // storage > public > img配下に画像が保存される
            $path = $up_img->store('img', 'public');

            $user->update([
                'icon_url' => 'storage/' . $path,
            ]);
        }
        $user->update([
            'name' => $request->input('name'),
            'bio' => $request->input('bio'),
            'web_url' => $request->input('web_url'),
        ]);


        return redirect()->route('management_company');
    }

    public function uploadImg(Request $request, $id)
    {

        $user = User::find($id);

        // 画像フォームでリクエストした画像情報を取得
        $up_img = $request->file('img_path');
        // storage > public > img配下に画像が保存される
        $path = $up_img->store('img', 'public');

        $user->update([
            'icon_url' => 'storage/' . $path,
        ]);

        return redirect()->route('user_edit');
    }

    //一般ユーザ側：企業のホームページの閲覧
    public function userside_comp_prof($id)
    {
        //$user_id = auth()->user()->id;
        //$company = User::find($user_id)->where('company_flg', '=', '0')->get();
        //$company = User::with('posts')->find($user_id);

        $user_info = User::withCount('follower_users')->find($id);
        $posts = $user_info->posts()->where('status', 1)->get();

        $user_bookmarks = User::find($id)->bookmark_total();

        if (auth()->user()) {
            //ログインしているユーザIDの取得
            $user_id = auth()->user()->id;
            //その企業をフォローしているか確認
            $isFollowing = Follow::where('user_id', $user_id)
                ->where('followed_user_id', $id)
                ->exists();
            $follow_action = '';
            //followしていなけらば    
            if (!$isFollowing) {
                $follow_action = "フォローする";
            } else {
                $follow_action = 'フォロー済み';
            }
        }else{
            $follow_action = 'フォローする';
        }
        //return $company;
        if ($user_info->company_flg == 0) {
            return view('userside_comp_prof', compact('user_info', 'posts', 'user_bookmarks', 'follow_action'));
            // return $company;
        } else {
            abort(404);
        }
    }

    //ユーザーがログインしたときに、company_flgでリダイレクトをする画面を変える
    public function branch()
    {

        $id  = auth()->user()->id;
        $user = User::find($id);

        if ($user->company_flg == 0) {
            return  redirect()->route('company_mypage');
        } else {
            return redirect()->route('timeline');
        }
    }

    public function general_mypage()
    {
        $user_id = auth()->user()->id;

        $user_info = User::with('bookmark_posts', 'followedCompanies')->withCount('bookmark_posts')->find($user_id);

        //return $user_info;
        return view('user_info', compact('user_info'));
    }
    public function general_mypage_show()
    {
        //ログインしているユーザーを取得
        $id = auth()->user()->id;
        //user情報を取得
        $user_info = User::find($id);

        return view('general_user_edit', compact(['user_info']));
    }
    public function general_mypage_edit(Request $request,)
    {

        $user = User::find(auth()->user()->id);

        // 画像フォームでリクエストした画像情報を取得
        $up_img = $request->file('img_path');
        if (!empty($up_img)) {

            // storage > public > img配下に画像が保存される
            $path = $up_img->store('img', 'public');

            $user->update([
                'icon_url' => 'storage/' . $path,
            ]);
        }
        $user->update([
            'name' => $request->input('name'),
            'bio' => $request->input('bio'),
        ]);

        return redirect()->route('userpage');
    }
}
