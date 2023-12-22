<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class UsersController extends Controller
{
    //

    public function index()
    {

        //ログインしているユーザーを取得
        $id = auth()->user()->id;
        //user情報を取得
        $user_info = User::find($id);
        //userの投稿の件数を取得
        $posts_number = Post::where('user_id', $id)->where('status', 1)->count();
        // dd($posts_number);
        return view('management_company', compact(['user_info'], 'posts_number'));
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

        $user->update([
            'name' => $request->input('name'),
            'bio' => $request->input('bio'),
            'web_url' => $request->input('web_url'),
        ]);
       
        
        return redirect()->route('management_company');
    }

    public function uploadImg(Request $request,$id){

        $user = User::find($id);

        // 画像フォームでリクエストした画像情報を取得
        $up_img = $request->file('img_path');
         // storage > public > img配下に画像が保存される
        $path = $up_img->store('img','public');

        $user->update([
            'icon_url'=>$path,
        ]);
       
        return redirect()->route('user_edit');
    }

    //一般ユーザのプロフィール
    public function userside_comp_prof(){
        $user_id = auth()->user()->id;
        //$company = User::find($user_id)->where('company_flg', '=', '0')->get();
        $company = User::with('posts')->find($user_id);

        //return $company;
        if($company->company_flg == 0){
        return view('userside_comp_prof',compact('company'));
        // return $company;
        }
    }

    //一般ユーザーのプロフィール編集画面
    public function prof_edit(){
        $user_id = auth()->user()->id;
        $company = User::with('posts')->find($user_id);
        
        return view('general_mypage_edit',compact('company'));
    }
    //一般ユーザのプロフィール画像を編集
    public function img_edit(Request $request,$id){
        $user = User::find($id);

        // 画像フォームでリクエストした画像情報を取得
        $up_img = $request->file('img_path');
         // storage > public > img配下に画像が保存される
        $path = $up_img->store('img','public');

        $user->update([
            'icon_url'=>$path,
        ]);
       
        return redirect()->route('general.mypage.edit');
    }

    //一般ユーザのプロフィール編集完了
    public function prof_edit_comp(Request $request, $id)
    {
        
        $user = User::find($id);

        $user->update([
            'name' => $request->input('name'),
            'bio' => $request->input('bio'),
            'web_url' => $request->input('web_url'),
        ]);
       
        
        return redirect()->route('userpage');
    }

    

    public function branch(){

        $id  =auth()->user()->id;
        $user = User::find($id);
    
        if($user->company_flg == 0){
            return  redirect()->route('company_mypage');
        }
        else{
            return redirect()->route('timeline') ;
        }

        
    }
}