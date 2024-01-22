@extends('layouts.general')
@section('content')
<section class="main_header flex">
    <h2>マイページ</h2>
    <div class="header_inner flex">
        <a class="js_add_button button create_button" href="{{url('/general/mypage/edit')}}">プロフィール編集</a>
    </div>
</section>
<div class="main_content">
    <div class="flex user_info_wrap">
        <div class="icon_wrap">
            <img src="{{ asset($user_info->icon_url)}}">
        </div>
        <div class="user_info">
            <h3>{{$user_info->name}}</h3>
            <div class="numbers">
                <span>お気に入り企業数<span class="strong">@if(empty($user_info->followed_companies)) 0 @else {{$user_info->followed_companies->count()}} @endif</span></span>
            </div>
            @if(strlen($user_info->bio) > 0)
            <p>{{ $user_info->bio }}</p>
            @endif
        </div>
    </div>
    <div class="user_bookmarks">
        <h2>ブックマーク</h2>
        @if(empty($user_info->bookmark_posts))
        <p>ブックマークがありません</p>
        @else
        <div class="flex">
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