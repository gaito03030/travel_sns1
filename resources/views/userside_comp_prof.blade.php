@extends('layouts.general')

@section('content')
<!-- ここからがページごとの表示部分 -->
<section class="main_header flex">
</section>
<article class="article">
    <article class="users">
        <div class="flex st_flex user_info_wrap">
            <div class="icon_wrap">
                <img src="{{asset($user_info->icon_url)}}">
            </div>
            <section class="user_info">
                <h1>{{$user_info->name}}</h1>
                <div class="flex st_flex">
                    <div class="numbers">
                        <span>総投稿数<span class="strong">{{count($posts)}}</span></span>
                    </div >
                    <div class="numbers">
                        <span>フォロワー<span class="strong">{{$user_info->follower_users_count}}</span></span>
                    </div >
                    <div class="numbers">
                        <span>総ブックマーク<span class="strong">{{$user_bookmarks}}</span></span>
                    </div >
                </div>
                <div class="article-info">
                    <p>{{$user_info->bio}}</p>
                    <a href="{{$user_info->web_url}}" class="user_url">{{$user_info->web_url}}</a>
                </div>
            </section>
            <button>followする</button>
            <p><a href="{{ route('test_follow',['id' => $user_info->id]) }}">フォローをする</a></p>
            {{-- <p><a href="{{ url('test_follow', ['id' => $user_info->id]) }}">フォローをする</a></p> --}}
        </div>
    </article>
    <article class="posts bookmarks">
        <div class="flex st_flex">
            @foreach($posts as $post)
            <a href="{{ url('/general/posts/'.$post->id) }}" class="slider_info">
                <div class="img_overflow_fide">
                    <img src=" {{asset($post->main_img_url)}} ">
                </div>
                <div class="title">
                    <p>{{$post->title}}</p>
                </div>
            </a>
            @endforeach
        </div>
        </div>
    </article>

</article>
</div>

@endsection