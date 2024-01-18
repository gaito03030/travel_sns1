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
        <h1><a href="{{ url('/') }}"><img src="{{asset('/img/logo.png') }}">とらべる～と</a></h1>
        @guest
        <ul class="login_buttons">
            <a class="login_button button">ログイン</a>
            <a class="register_button button">新規登録</a>
        </ul>
        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        @endguest


    </header>
    <div class="flex">
        <nav class="main_nav">
            <ul class="nav">
                <li><a href="{{ url('/company_mypage') }}"><img src="img/home.png" width="26px">ホーム</a></li>
                <li><a href="{{ url('/create') }}"><img src="img/create.png" width="26px">新規作成</a></li>
                <li><a href="{{ url('/management_company') }}"><img src="img/mypage.png" width="26px">マイ企業情報管理</a></li>
                <li><a href="{{ url('/notification') }}">
                        <!-- 未読通知があれば画像を変更 -->
                        @guest
                        <img src="img/alert.png">
                        @else
                        @if (Auth::user()->notifications_unread())
                        <img src="img/alert_unread.png" width="26px">
                        @else
                        <img src="img/alert.png" width="26px">
                        @endif
                        @endguest
                        通知</a></li>
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