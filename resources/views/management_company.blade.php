@extends('layouts.company')

@section('content')
    <!-- ここからがページごとの表示部分 -->
    <section class="main_header flex">
        <h2>マイ企業情報管理</h2>
        <div class="header_inner flex">
            <a class="js_add_button button create_button" href="{{url('/user_edit')}}">編集</a>
        </div>
    </section>
    <div class="main_content">
        <div class="flex user_info_wrap">
            <div class="icon_wrap">
                <img src="{{ $user_info->icon_url}}">
            </div>
            <div class="user_info">
                <h3>{{$user_info->name}}</h3>
                <div class="numbers">
                    <span>公開中の投稿<span class="strong">X</span>件</span>
                    <span>お気に入り数<span class="strong">X</span>件</span>
                    <span>総ブックマーク数<span class="strong">X</span>件</span>
                </div>
                <h4>ひとこと</h4>
                @if(strlen($user_info->bio) > 0)
                <p>{{ $user_info->bio }}</p>
                @else
                <p>設定されていません</p>
                @endif
                <h4>公式ホームページURL</h4>
                @if(strlen($user_info->web_url) > 0)
                <p>{{ $user_info->web_url}}</p>
                @else
                <p>設定されていません</p>
                @endif
            </div>
        </div>
    </div>
    @endsection