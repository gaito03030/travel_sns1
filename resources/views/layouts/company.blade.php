<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,200,0,0" />

    <!-- css -->
    <!-- @vite('resources/css/style.css') -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

<body>
    <header id="header">
        <h1><a href="{{ url('/') }}"><img  src="{{asset('/img/logo.png') }}">とらべる～と</a></h1>
    </header>
    <div class="flex">
        <nav class="main_nav">
            @auth
            <div class="nav_myinfo">
                <div class="img_cover_circle">
                    <img src="{{Auth::user()->icon_url}}" width="50px" height="50px">
                </div>
                <div class="myinfo_text">
                    <p class="my_name">{{Auth::user()->name}}</p>
                    <p class="followers">000</p>
                    <p class="followers_title">followers</p>
                </div>
            </div>
            @endauth
            <ul class="nav">
                <li><a href="{{ url('/company_mypage') }}"><img src="img/home.png" width="26px">ホーム</a></li>
                <li><a href="{{ url('/create') }}"><img src="img/create.png" width="26px">新規作成</a></li>
                <li><a href="{{ url('/management_company') }}"><img src="img/mypage.png" width="26px">マイ企業情報管理</a></li>
                <li><a href="{{ url('/notification') }}">
                        <!-- 未読通知があれば画像を変更 -->
                        @if (Auth::user()->notifications_unread())
                        <img src="img/alert_unread.png" width="26px">
                        @else
                        <img src="img/alert.png" width="26px">
                        @endif
                        通知</a></li>
                <li><a href="{{ url('/logout') }}"><img src="img/home.png" width="26px">ログアウト</a></li>
            </ul>
        </nav>
        <main class="main">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    @vite( ['resources/js/jquery-3.7.0.min.js','resources/js/app.js','resources/js/preview.js','resources/js/post.js'])

</body>

</html>