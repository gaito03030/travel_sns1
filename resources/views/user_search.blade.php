<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h2>検索</h2>
    <form action="{{route('post_search_result')}}" method="get">
        <input type="text" name="search_text"><br>
        絞り込み条件<br>
        ・エリア<br>
        @foreach($prefs as $pref)
        <label>
            <input type="checkbox" name="prefs" value="{{$pref->id}}">{{$pref->name}}
        </label>
        @endforeach
        <br>
        ・カテゴリー<br>
        @foreach($categorys as $category)
            <label>
                <input type="checkbox" name="categorys" value="{{ $category->id }}">{{ $category->category }}<br>
            </label>
        @endforeach
        
    </form>
    <li><a href="{{ url('/logout') }}">ログアウト</a></li>
</body>

</html>