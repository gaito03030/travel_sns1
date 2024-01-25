<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="manifest" href="/manifest.json">
</head>

<body>
    <ul class="nav">
        <li><a href="{{ url('/company_mypage') }}"><img src="img/home.png" width="26px">ホーム</a></li>
        <li><a href="{{ url('/create') }}"><img src="img/create.png" width="26px">新規作成</a></li>
        <li><a href="{{ url('/management_company') }}"><img src="img/mypage.png" width="26px">マイ企業情報管理</a></li>
        <li><a href="{{ url('/notification') }}"><img src="img/alert.png" width="26px">通知</a></li>
        <li><a href="{{ url('/logout') }}">ログアウト</a></li>
    </ul>

    @if(session('alert') !== Null)
    <p>{{ session('alert') }}</p>
    @endif
</body>

</html>