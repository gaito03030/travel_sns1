<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;

class FollowsController extends Controller
{
    //
    public function index($user_id){
         //ログインしているユーザーを取得
         $id = auth()->user()->id;
         //クリックした企業の情報を取得
         $company_info = User::find($user_id);

         return $company_info;
    }
}
