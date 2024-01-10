<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>通知設定</h2>
    <ul class="nav">
        <li><a href="{{ url('/timeline') }}">ホーム</a></li>
        <li><a href="{{ url('/search') }}">検索</a></li>
        <li><a href="{{ url('general/mypage') }}">マイページ</a></li>
        <li><a href="{{ url('/notification') }}">通知</a></li>
</ul>
    <form action="{{ url('/notification/setting/update') }}" method="POST">
        @csrf
        <label><input type="radio" name="notice_all" value="1" @if($setting->notice_all_flg) checked @endif
            >
            すべての通知を許可</label><br>
        <label>
            <input type="radio" name="notice_all" value="0" @if(!$setting->notice_all_flg) checked @endif>通知ごとに設定<br>
            お気に入り企業の投稿<input type="hidden" name="post" value="0">
                        <input type="checkbox" name="post" value="1" @if($setting->notice_comment_flg) checked @endif><br>
            コメントへの返信<br>
            <label><input type="radio" name="reply"  value="2">すべて許可</label><br>
            <label><input type="radio" name="reply" value="1">投稿主による返信のみ許可</label><br>
            <label><input type="radio" name="reply" value="0">拒否</label><br>
        </label>
        <input type="submit" value="更新">
    </form>
</body>

</html>