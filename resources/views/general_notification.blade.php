<head>
    <link rel="manifest" href="/manifest.json">
</head>

@extends('layouts.general')

@section('content')
<!-- ここからがページごとの表示部分 -->
<section class="main_header flex">
    <h2>通知</h2>
    <div class="header_inner flex">
        <a class="button create_button" href="{{url('general/notification/setting')}}">通知設定</a>
    </div>
</section>
<div class="main_content">

    @if(($new_notifications->count() <= 0) && ($read_notifications->count() <= 0))
    <div class="notice_wrap">
        <div class="empty">
            <p>通知はありません</p>
        </div>
    </div>
    @else

    @if((!empty($new_notifications)) && ($new_notifications->count() > 0 ))
    <div class="notice_wrap"><!--new_notifications-->
    <p class="notice_text">最新</p>
    <table class="notice_list">
            @foreach($new_notifications as $notification)
            <tr class="notice">
                <td>
                    <!-- 通知の種類によって画像を変更 -->
                    @if($notification->type ==='いいね')
                    <img src="{{url('img/notice_like.png')}}">
                    @elseif($notification->type === 'ブックマーク')
                    <img src="{{url('img/notice_bookmark.png')}}">
                    @elseif($notification->type == 'コメント')
                    <img src="{{url('img/notice_comment.png')}}">
                    @elseif($notification->type == '返信')
                    <img src="{{url('img/notice_comment.png')}}">
                    @elseif($notification->type == 'フォロー')
                    <img src="{{url('img/notice_follow.png')}}">
                    @endif
                </td>
                <td>{!! $notification->body !!}</td>
                <td>XX分前</td>
                <td><a class="button" href="{{url($notification->url)}}">投稿を確認</a></td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif
    @if((!empty($read_notifications)) && ($read_notifications->count() > 0 ))
    <div class="notice_wrap"><!--read_notifications-->
    <p class="notice_text">既読</p>
    <table class="notice_list">
            @foreach($read_notifications as $notification)
            <tr class="notice">
                <td>
                    <!-- 通知の種類によって画像を変更 -->
                    @if($notification->type ==='いいね')
                    <img src="{{url('img/notice_like.png')}}">
                    @elseif($notification->type === 'ブックマーク')
                    <img src="{{url('img/notice_bookmark.png')}}">
                    @elseif($notification->type == 'コメント')
                    <img src="{{url('img/notice_comment.png')}}">
                    @elseif($notification->type == '返信')
                    <img src="{{url('img/notice_comment.png')}}">
                    @elseif($notification->type == 'フォロー')
                    <img src="{{url('img/notice_follow.png')}}">
                    @endif
                </td>
                <td>{!! $notification->body !!}</td>
                <td>XX分前</td>
                <td><a class="button" href="{{url($notification->url)}}">投稿を確認</a></td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif
    @endif
</div>
@endsection