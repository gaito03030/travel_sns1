<head>
    <link rel="manifest" href="/manifest.json">
</head>

@extends('layouts.company')

@section('content')
<!-- ここからがページごとの表示部分 -->
<div class="js_bg">
    <div class="js_popup">
        <h2>削除</h2>
        <p>削除してよろしいですか？</p>
        <div class="js_popup_buttons">
            <button class="button js_popup_cancel_btn">キャンセル</button>
            <a class="button js_popup_delete_btn" href="">削除する</a>
        </div>
    </div>
</div>
<section class="main_header flex">
    <h2>マイモデルコース</h2>
    <div class="header_inner flex">
        <form class="search_wrap" action="{{ route('company_mypage.posts') }}" method="get">
            <input class="input_search" type="search" placeholder="検索" name="search" value="{{ request('search') }}">
            <button type="submit" class="search_button">
                <i class="fas fa-search fa-fw"></i>
            </button>
        </form>
        <a class="js_add_button create_button button" href="{{url('/company/create')}}">＋ 新規追加</a>
    </div>
</section>
<div class="main_content">
    @yield('content')
    @if(count($myPosts) == 0)
    <div class="empty_box">
        <img src="{{asset('/img/empty.png')}}">
        <p>モデルコースが登録されていません</p>
        <a href="{{url('/company/create')}}" class="button">＋ 新規追加</a>
    </div>
    @endif
    @foreach ($myPosts as $post)
    <article class="post flex">
        <div class="thumbnail">
            <img src="{{ asset( $post->main_img_url) }}">
        </div>
        <div class="post_text">
            <div class="post_title">
                <h3>{{ $post->title }}</h3>
                @if($post->status !== 1)
                <span class="status_tag status_private">非公開</span>
                @else
                <span class="status_tag">公開中</span>
                @endif
            </div>
            <div class="flex post_text_wrap">
                <p class="post_text"><?php echo mb_strimwidth(strip_tags($post->description), 0, 140, '…', 'UTF-8'); ?></p>
                <div class="post_buttons flex">
                    <a href="#" class="js_delete_button" data-delete_link="{{url('company/delete/exe/'.$post->id)}}" title="削除"><span class="material-symbols-outlined">delete</span></a>
                    <a href="{{ url( '/company/create/edit/'.$post->id ) }}" title="編集"><span class="material-symbols-outlined">stylus</span></a>
                </div>
            </div>
        </div>
    </article>
    @endforeach
    <div class="courses">
        <section class="course"></section>
    </div>
</div>
@endsection