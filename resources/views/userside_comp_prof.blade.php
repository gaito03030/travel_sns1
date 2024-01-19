@extends('layouts.general')

@section('content')
<!-- ここからがページごとの表示部分 -->
<section class="main_header flex">
    <article class="article">
        <article class="users">
            <img src="{{asset($user_info->icon_url)}}">
            <section class="user_info">
                <h1>{{$user_info->name}}</h1>
                <ul>
                    <li class="follower_num">
                        follwer:{{$user_info->follower_users_count}}
                    </li>
                    <li class="bookmarks_num">
                        bookmarks:{{$user_bookmarks}}
                    </li>
                </ul>
                <div class="article-info">
                    <p>{{$user_info->bio}}</p>
                    <a href="{{$user_info->web_url}}" class="user_url">{{$user_info->web_url}}</a>
                </div>
            </section>
            <button>followする</button>
        </article>
        <article class="posts">
            @foreach($posts as $post)
            <div class="slider">
                <img src=" {{asset($post->main_img_url)}} ">
                <p>{{$post->title}}</p>
            </div>
            @endforeach
        </article>

    </article>
</section>
</div>

@endsection