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
<section class="main_header st_flex flex">
    <h2>マイページ</h2>
    <div class="header_inner st_flex flex">
        <a class="js_add_button button create_button" href="{{url('/general/mypage/edit')}}">プロフィール編集</a>
    </div>
</section>
<div class="main_content">
    <div class="flex st_flex user_info_wrap">
        <div class="icon_wrap">
            <img src="{{ asset($user_info->icon_url)}}">
        </div>
        <div class="user_info">
            <h3>{{$user_info->name}}</h3>
            <div class="flex flex_center follow_wrap st_flex">
                <div class="numbers">
                    <span>お気に入り企業数<span class="strong"> {{$user_info->bookmark_posts_count}} </span></span>
                </div>
                <a class="js_add_button button create_button follow_list_button" href="{{route('follow_list')}}">一覧表示</a>
            </div>

            @if(strlen($user_info->bio) > 0)
            <p>{{ $user_info->bio }}</p>
            @endif
        </div>
    </div>
    <div class="user_bookmarks bookmarks">
        <h2>ブックマーク</h2>
        @if(count($user_info->bookmark_posts) == 0)
        <p>ブックマークが登録されていません</p>
        @else
        <div class="flex st_flex">
            @foreach($user_info->bookmark_posts as $item)
            <a href="{{ url('/general/posts/'.$item->id) }}" class="slider_info">
                <div class="img_overflow_fide">
                    <img src="{{asset($item->main_img_url)}}" alt="">
                </div>
                <div class="title">
                    <p>{{$item->title}}</p>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</div>

@endsection