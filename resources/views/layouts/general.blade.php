<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>とらべる～と</title>
    <link href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,200,0,0" />
    <!-- css -->
    <!-- @vite('resources/css/style.css') -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite( ['resources/sass/app.scss','resources/js/jquery-3.7.0.min.js','resources/js/app.js','resources/js/preview.js','resources/js/post.js'])

<body>
    <header id="header" class="flex flex_center">
        <h1><a href="{{ url('/timeline') }}"><img src="{{asset('/img/logo.png') }}"><span>とらべる～と</span></a></h1>
        @guest
        <ul class="login_buttons">
            <li><a class="login_button button">ログイン</a></li>
            <li><a class="register_button button">新規登録</a></li>
        </ul>
        @else
        <div class="flex general_header_inner flex_center">
            <div class="img_cover_circle general_user_icon">
                <img src="{{asset(Auth::user()->icon_url)}}" width="50px" height="50px">
            </div>
            <ul class="navbar-nav">
                <li></li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            {{ __('ログアウト') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        @endguest
    </header>
    <div class="flex">
        <nav class="main_nav general_nav">
            <ul class="nav_wrap">
                <li><a href="{{ url('/timeline') }}"><img src="{{url('img/home.png')}}" width="26px">ホーム</a></li>
                <li><a href="{{ url('/search') }}"><img src="{{url('img/create.png')}}" width="26px">検索</a></li>
                <li><a href="{{ url('/management_company') }}"><img src="{{url('img/mypage.png')}}" width="26px">マイページ</a></li>
                <li><a href="{{ url('/notification') }}">
                        <!-- 未読通知があれば画像を変更 -->
                        @guest
                        <img src="{{url('img/alert.png')}}" width="26px">
                        @else
                        @if (Auth::user()->notifications_unread())
                        <img src="{{url('img/alert_unread.png')}}" width="26px">
                        @else
                        <img src="{{url('img/alert.png')}}" width="26px">
                        @endif
                        @endguest
                        通知</a></li>
            </ul>
        </nav>

        <main class="main_general">
            @yield('content')
        </main>
    </div>

</body>

</html>