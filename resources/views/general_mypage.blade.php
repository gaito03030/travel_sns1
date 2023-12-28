<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <ul class="nav">
        <li><a href="{{ url('/timeline') }}">ホーム</a></li>
        <li><a href="{{ url('/search') }}">検索</a></li>
        <li><a href="{{ url('general/mypage') }}">マイページ</a></li>
        <li><a href="{{ url('/notification') }}">通知</a></li>
    </ul>

    <h2>マイページ</h2>
    <p>{{$user->name}}</p>
    <img src="{{ asset($user->icon_url)}}" width="100px" height="100px">
    <p>BIO:
        @if(isset($user->bio)){{$user->bio}}
        @else 自己紹介を設定してください
        @endif</p>
    <h3>ブックマーク:{{$bookmarks_count}}件</h3>
    @if($bookmarks_count > 0))
    @foreach($bookmarks as $bookmark)
    <p>{{$bookmark->title}}</p>
    @endforeach
    @else
    <P>ブックマークが登録されていません</P>
    @endif

</body>

</html>