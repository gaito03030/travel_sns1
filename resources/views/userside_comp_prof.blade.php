@extends('layouts.general')

@section('content')
<!-- ここからがページごとの表示部分 -->
    <article class="users">
        <div class="flex st_flex user_info_wrap user_company_general">
            <div class="icon_wrap">
                <img src="{{asset($user_info->icon_url)}}">
            </div>
            <section class="user_info">
                <div class="st_flex user_name_wrap">
                    <h2>{{$user_info->name}}</h2>
                    <a href="{{ route('test_follow',['id' => $user_info->id]) }}" class="st_block button">{{$follow_action}}</a>
                </div>
                <div class="flex st_flex numbers_wrap">
                    <div class="numbers">
                        <span>総投稿数<span class="strong">{{count($posts)}}</span></span>
                    </div>
                    <div class="numbers">
                        <span>フォロワー<span class="strong">{{$user_info->follower_users_count}}</span></span>
                    </div>
                    <div class="numbers">
                        <span>総ブックマーク<span class="strong">{{$user_bookmarks}}</span></span>
                    </div>
                    <a href="{{ route('test_follow',['id' => $user_info->id]) }}" class="button st_none">{{$follow_action}}</a>
                </div>
                @if(!empty($user_info->bio) && !empty($user_info->web_url))
                <div class="article-info">
                    <p>{{$user_info->bio}}</p>
                    <a href="{{$user_info->web_url}}" class="user_url">{{$user_info->web_url}}</a>
                </div>
                @endif
            </section>
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