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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!-- css -->
    <!-- @vite('resources/css/style.css') -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="manifest" href="/manifest.json">
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/serviceworker.js').then(function() {
                console.log("Service Worker is registered!!");
            });
        }
    </script>

<body>
    <header id="header">
        <h1><a href="{{ url('/company/') }}"><img src="{{asset('/img/logo.png') }}"><span>とらべる～と</span></a></h1>
    </header>
    <div class="nav_bg"></div>
    <div class="nav_openbtn st_block"><span></span><span></span><span></span></div>
    <div class="flex st_flex">
        <nav class="main_nav">
            @auth
            <div class="nav_myinfo">
                <div class="nav_info_wrap">
                <div class="img_cover_circle">
                    <img src="{{asset(Auth::user()->icon_url)}}" width="45px" height="45px">
                </div>
                <div class="myinfo_text">
                    <p class="my_name">{{Auth::user()->name}}</p>
                    <p class="followers">{{count(Auth::user()->follower_users)}}</p>
                    <p class="followers_title">followers</p>
                </div>
                </div>
            </div>
            @endauth
            <ul class="nav">
                <li><a href="{{ url('/company/') }}"><img src="{{url('img/home.png')}}" width="26px">ホーム</a></li>
                <li><a href="{{ url('/company/create') }}"><img src="{{url('img/create.png')}}" width="26px">新規作成</a></li>
                <li><a href="{{ url('/company/mypage') }}"><img src="{{url('img/mypage.png')}}" width="26px">マイ企業情報管理</a></li>
                <li><a href="{{ url('/company/notification') }}">
                        <!-- 未読通知があれば画像を変更 -->
                        @if (Auth::user()->notifications_unread())
                        <img src="{{url('img/alert_unread.png')}}" width="26px">
                        @else
                        <img src="{{url('img/alert.png')}}" width="26px">
                        @endif
                        通知</a></li>
                <li><a href="{{ url('/logout') }}"><img src="{{url('img/logout.png')}}" width="26px">ログアウト</a></li>
            </ul>
        </nav>
        <main class="main_wrap">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    @vite( ['resources/js/app.js','resources/js/preview.js','resources/js/post.js','resources/js/setting.js','resources/js/popup.js','resources/js/script.js'])

</body>

</html>