<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="manifest" href="/manifest.json">
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/serviceworker.js').then(function() {
                console.log("Service Worker is registered!!");
            });
        }
    </script>
</head>
<body>
    <h2>ブックマーク</h2>
    <p>{{ Auth::user()->name }}さんのブックマーク 総数:{{count($data['posts'])}}件</p>

    @foreach($data['posts'] as $post)
        <a href="{{ url('/posts/'.$post->id) }}">{{$post->title}}</a>
    @endforeach
    <a href="{{ url('/logout') }}">ログアウト</a>
</body>
</html>