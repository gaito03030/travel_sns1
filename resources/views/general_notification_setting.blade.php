<head>
    <link rel="manifest" href="/manifest.json">
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/serviceworker.js').then(function() {
                console.log("Service Worker is registered!!");
            });
        }
    </script>
</head>


@extends('layouts.general')

@section('content')
<!-- ここからがページごとの表示部分 -->
<section class="main_header flex">
    <h2>通知設定</h2>
</section>
<div class="main_content">
    <form class="notice_form" action="{{ url('/notification/setting/update') }}" method="POST">
        <span class="input_title">通知の許可</span>
        @csrf
        <label><input type="radio" name="notice_all" value="1" @if($setting->notice_all_flg) checked @endif >
            すべての通知を許可</label><br>
        <label>
            <input type="radio" name="notice_all" value="0" @if(!$setting->notice_all_flg) checked @endif>通知ごとに設定<br>
            <div class="input_group">
                <div class="flex input_flex_notice toggle_wrap">
                    <span>お気に入り企業の投稿</span>
                    <input type="hidden" name="posted" value="0">
                    <div class="toggle_button">
                        <input id="toggle" class="toggle_input js_disable" name="posted" @if($setting->notice_all_flg) disabled @endif value="1" @if($setting->notice_posted_flg) checked @endif type='checkbox'>
                        <label for="toggle" class="toggle_label"></label>
                    </div>
                </div>
                <div class="flex input_flex_notice toggle_wrap">
                    <span>コメントへの返信</span>
                    <input type="hidden" name="comment" value="0">
                    <div class="toggle_button">
                        <input id="toggle" @if($setting->notice_all_flg) disabled @endif class="toggle_input js_disable" name="comment" value="1" @if(($setting->notice_reply_flg) && ($setting->notice_poster_reply_flg)) checked @endif type='checkbox'>
                        <label for="toggle" class="toggle_label"></label>
                    </div>
                </div>
            </div>
        </label>

        <input class="button notice_submit" type="submit" value="更新">
    </form>
</div>
<!--
<form action="{{ url('/notification/setting/update') }}" method="POST">
    @csrf
    <label><input type="radio" name="notice_all" value="1" @if($setting->notice_all_flg) checked @endif >
        すべての通知を許可</label><br>
    <label>
        <input type="radio" name="notice_all" value="0" @if(!$setting->notice_all_flg) checked @endif>通知ごとに設定<br>
        いいねの通知 <input type="hidden" name="like" value="0">
        <input type="checkbox" name="like" value="1" @if($setting->notice_like_flg) checked @endif><br>
        コメントの通知<input type="hidden" name="comment" value="0">
        <input type="checkbox" name="comment" value="1" @if($setting->notice_comment_flg) checked @endif><br>
        ブックマーク通知<input type="hidden" name="bookmark" value="0">
        <input type="checkbox" name="bookmark" value="1" @if($setting->notice_bookmark_flg) checked @endif><br>
        お気に入り登録通知<input type="hidden" name="follow" value="0">
        <input type="checkbox" name="follow" value="1" @if($setting->notice_follow_flg) checked @endif><br>
    </label>
    <input type="submit" value="更新">
</form>
-->

@endsection
<!--
    <form action="{{ url('/notification/setting/update') }}" method="POST">
        @csrf
        <label><input type="radio" name="notice_all" value="1" @if($setting->notice_all_flg) checked @endif
            >
            すべての通知を許可</label><br>
        <label>
            <input type="radio" name="notice_all" value="0" @if(!$setting->notice_all_flg) checked @endif>通知ごとに設定<br>
            お気に入り企業の投稿<input type="hidden" name="post" value="0">
                        <input type="checkbox" name="post" value="1" @if($setting->notice_comment_flg) checked @endif><br>
            コメントへの返信<br>
            <label><input type="radio" name="reply"  value="2">すべて許可</label><br>
            <label><input type="radio" name="reply" value="1">投稿主による返信のみ許可</label><br>
            <label><input type="radio" name="reply" value="0">拒否</label><br>
        </label>
        <input type="submit" value="更新">
    </form>
-->