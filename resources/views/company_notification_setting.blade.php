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
        <li><a href="{{ url('/company_mypage') }}"><img src="img/home.png" width="26px">ホーム</a></li>
        <li><a href="{{ url('/create') }}"><img src="img/create.png" width="26px">新規作成</a></li>
        <li><a href="{{ url('/management_company') }}"><img src="img/mypage.png" width="26px">マイ企業情報管理</a></li>
        <li><a href="{{ url('/notification') }}"><img src="img/alert.png" width="26px">通知</a></li>
        <li><a href="{{ url('/logout') }}">ログアウト</a></li>
    </ul>
    <form action="{{ url('/notification/setting/update') }}" method="POST">
        @csrf
        <label><input type="radio" name="notice_all" value="1" @if($setting->notice_all_flg) checked @endif >
            すべての通知を許可</label><br>
        <label>
            <input type="radio" name="notice_all" value="0" @if(!$setting->notice_all_flg) checked @endif>通知ごとに設定<br>
            いいねの通知 <input type="hidden" name="like" value="0">
            <input type="checkbox" name="like" value="1" @if($setting->notice_like_flg) checked @endif><br>
            コメントの通知<input type="hidden" name="comment" value="0">
            <input type="checkbox" name="comment" value="1" @if($setting->notice_comment_flg) checked @endif><br>
            ブックマーク通知<input type="hidden" name="bookmark" value="0">
            <input type="checkbox" name="bookmark" value="1" @if($setting->notice_bookmark_flg) checked @endif><br>
            お気に入り登録通知<input type="hidden" name="follow" value="0">
            <input type="checkbox" name="follow" value="1" @if($setting->notice_follow_flg) checked @endif><br>
        </label>
        <input type="submit" value="更新">
    </form>
</body>

</html>