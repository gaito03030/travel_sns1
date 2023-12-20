<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <ul class="nav">
        <li><a href="{{ url('/timeline') }}">ホーム</a></li>
        <li><a href="{{ url('/search') }}">検索</a></li>
        <li><a href="#">マイページ</a></li>
        <li><a href="{{ url('/notification') }}">通知</a></li>
    </ul>
    <h2>Post</h2>
    <p>id:{{$data['post']->id}}</p>
    <p>title:{{$data['post']->title}}</p>
    <p>main_img_url:{{$data['post']->main_img_url}}</p>
    <p>description:{{$data['post']->description}}</p>
    <h2>user</h2>
    <p>user_id:{{$data['post']->user->id}}</p>
    <p>user_id:{{$data['post']->user->name}}</p>
    <p>user_id:{{$data['post']->user->icon_url}}</p>
    <h2>category</h2>
    <p>category:{{$data['post']->category->category}}</p>
    <h2>pref</h2>
    <p>pref:{{$data['post']->pref->name}}</p>
    <h2>details</h2>
    @foreach($data['post']->details as $detail)
    <h4>title:{{$detail->title}}</h4>
    <p>content:{{$detail->content}}</p>
    @endforeach
    <h2>spots</h2>
    @foreach($data['post']->spots as $spot)
    <h4>title:{{$spot->title}}</h4>
    <p>description:{{$spot->description}}</p>
    <p>address:{{$spot->address}}</p>
    @endforeach

    <!--ブックマーク-->
    <h3>ブックマーク</h3>
    <p>ブックマーク数:{{$data['bookmarks']}}件</p>
    @if (!Auth::user()->is_bookmark($data['post']->id))
    <form action="{{ route('bookmark.store', $data['post']->id) }}" method="post">
        @csrf
        <button>お気に入り登録</button>
    </form>
    @else
    <form action="{{ route('bookmark.destroy', $data['post']->id) }}" method="post">
        @csrf
        @method('delete')
        <button>お気に入り解除</button>
    </form>
    @endif

    <!--いいね-->

        <!-- いいね -->
        <h3>いいね</h3>
        <p>いいね数</p>

    <!-- コメント -->
    <h3>コメント</h3>
    @forelse($data['post']->comments as $comment)
    <div class="card">
        <div class="card-body">
            <img src="{{ asset($comment->user->icon_image_url) }}" width="50px">
            {{ $comment->user->name}}
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
                <button type="submit" class="btn btn-primary">
                    {{ __('コメントを投稿') }}
                </button>
            </div>
        </div>
    </form>
    </div>
    
    <a href="{{ url('/logout') }}">ログアウト</a>

</body>

</html>