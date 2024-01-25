<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
    <link rel="manifest" href="/manifest.json">
</head>
@extends('layouts.general')
@section('content')
<div class="post_wrap">
    <div class="post_main_img">
        <img src="{{asset($data['post']->main_img_url)}}">
    </div>
    <div class="post_content">
        <span class="post_category_tag">{{$data['post']->category->category}}</span>
        <div class="post_info post_content">
            <h2>{{$data['post']->title}}</h2>
            <div class="post_description">
                <p>{{$data['post']->description}}</p>
            </div>
            <div class="flex st_flex">
                <div class="flex st_flex flex_center location_wrap">
                    <span class="material_fill material-symbols-outlined">pin_drop</span>
                    <p>{{$data['post']->pref->name}}</p>
                </div>
                <div class="post_price flex st_flex flex_center location_wrap">
                    <span class="material-symbols-outlined">
                        currency_yen
                    </span>
                    <p>{{$data['post']->price}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="details">
        @foreach($data['post']->details as $detail)
        <div class="detail">
            <h3>{{$detail->title}}</h3>
            <p>{{$detail->content}}</p>
        </div>
        @endforeach
    </div>
    <div class="post_schedule">
        <h2>Schedule</h2>
        @foreach($data['post']->spots as $spot)
        <div class="spot">
            <h4>{{$spot->title}}</h4>
            <p>{{$spot->description}}</p>
            <div class="flex st_flex flex_center location_wrap">
                <span class="material_fill material-symbols-outlined">pin_drop</span>
                <p>{{$spot->address}}</p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="post_counts_wrap st_flex flex">
        <div class="count">
            <h3>ブックマーク</h3>
            @guest
            <button title="ログインしてください"><span class="material-symbols-outlined unchecked">
                    bookmark
                </span></button>
            @else
            @if (!Auth::user()->is_bookmark($data['post']->id))
            <form action="{{ route('bookmark.store', $data['post']->id) }}" method="post">
                @csrf
                <button><span class="material-symbols-outlined unchecked">
                        bookmark
                    </span></button>
            </form>
            @else
            <form action="{{ route('bookmark.destroy', $data['post']->id) }}" method="post">
                @csrf
                @method('delete')
                <button><span class="material-symbols-outlined checked">
                        bookmark
                    </span></button>
            </form>
            @endif
            @endguest
            <p>{{$data['bookmarks']}}</p>
        </div>
        <!--いいね-->
        <div class="count">
            <h3>いいね</h3>
            @guest
            <button>
                <span title="ログインしてください" class="material-symbols-outlined unchecked">
                    favorite
                </span>
            </button>
            @else
            @if (!Auth::user()->is_like($data['post']->id))
            <form action="{{ route('like.store', $data['post']->id) }}" method="post">
                @csrf
                <button>
                    <span class="material-symbols-outlined unchecked">
                        favorite
                    </span>
                </button>
            </form>
            @else
            <form action="{{ route('like.destroy', $data['post']->id) }}" method="post">
                @csrf
                @method('delete')
                <button>
                    <span class="material-symbols-outlined checked">
                        favorite
                    </span>
                </button>
            </form>
            @endif
            @endguest
            <p>{{$data['likes']}}</p>

        </div>

    </div>
    <div class="post_user_info">
        <div class="flex flex_center">
            <div class="img_cover_circle general_user_icon">
                <img src="{{asset($data['post']->user->icon_url)}}" alt="">
            </div>
            <p>{{$data['post']->user->name}}</p>
            <a class="button" href="{{ url('/general/user/'.$data['post']->user->id) }}">ユーザ情報を表示</a>
        </div>
    </div>

    <!-- コメント -->
    <div class="post_comment_wrap">
        <h2>コメント</h2>
        @forelse($data['post']->comments as $comment)
        <div class="card">
            <div class="card-body">
                <div class="flex flex_center">
                    <div class="img_cover_circle general_user_icon">

                        <img src="{{ asset($comment->user->icon_url) }}" width="50px">
                    </div>
                    {{ $comment->user->name}}
                </div>
                <p>{{$comment->detail}}</p>
                @foreach($comment->replies as $reply)
                <div class="card">
                    <dic class="card-body">
                        <img src="{{ asset($reply->user->icon_image_url) }}" width="50px">
                        {{ $reply->user->name}}
                        <p>{{$reply->detail}}</p>
                    </dic>
                </div>
                @endforeach
                <a href="{{ url('reply/'.$data['post']->id.'/'.$comment->id) }}">返信</a>
            </div>
        </div>
        @empty
        <div class="card">
            <div class="card-body">
                <p>コメントはまだありません</p>
            </div>
        </div>
        @endforelse
        <form method="POST" action="{{ route('comment.store',$data['post']->id) }}">
            @csrf

            <label for="detail" class="form-label">コメントを入力</label><br>
            <textarea name="detail" class="form-control" id="detail" rows="3"></textarea>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button class="button" type="submit" class="btn btn-primary">
                        {{ __('コメントを投稿') }}
                    </button class="button">
                </div>
            </div>
        </form>
    </div>
</div>
</div>

@endsection