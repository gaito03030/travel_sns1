@extends('layouts.company')

@section('content')
<!-- ここからがページごとの表示部分 -->
<section class="main_header flex">
    <h2>通知</h2>
    <div class="header_inner flex">
        <a class="button create_button" href="{{url('/notification/setting')}}">通知設定</a>
    </div>
</section>
<div class="main_content">
    @if(empty($new_notifications) && empty($read_notifications))
    <div class="notice_wrap">
        <div class="empty">
            <p>通知はありません</p>
        </div>
    </div>
    @else
    <div class="notice_wrap"><!--read_notifications-->
    <p class="notice_text">最新</p>
    <table class="notice_list">
            @foreach($read_notifications as $notification)
            <tr class="notice">
                <td>
                    <!-- 通知の種類によって画像を変更 -->
                    @if($notification->type =="いいね")
                    <img src="img/notice_like.png">
                    @elseif($notification->type == "ブックマーク")
                    <img src="img/notice_bookmark.png">
                    @elseif($notification->type == "コメント")
                    <img src="img/notice_comment.png">
                    @elseif($notification->type == "フォロー")
                    <img src="img/notice_follow.png">
                    @endif
                </td>
                <td>{!! $notification->body !!}</td>
                <td>XX分前</td>
                <td><a class="button">投稿を確認</a></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="notice_wrap">
        <p class="notice_text">先月</p>
        <table class="notice_list">
            <tr class="notice">
                <td><img src="./image/icon_default.png"></td>
                <td>モデルコース XXXXX にいいねがつきました</td>
                <td>XX分前</td>
                <td><button class="button">投稿を確認</button></td>
            </tr>
            <tr class="notice">
                <td><img src="./image/icon_default.png"></td>
                <td>モデルコース XXXXX にいいねがつきました</td>
                <td>XX分前</td>
                <td><button class="button">投稿を確認</button></td>
            </tr>
        </table>
    </div>
    @endif
</div>
@endsection