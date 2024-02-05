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
    <link rel="manifest" href="/manifest.json">
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/serviceworker.js').then(function() {
                console.log("Service Worker is registered!!");
            });
        }
    </script>

    @vite( ['resources/sass/app.scss'])

<body>
    <header id="header" class="flex st_flex flex_center">
        <h1><a href="{{ url('/') }}"><img src="{{asset('/img/logo.png') }}"><span>とらべる～と</span></a></h1>
        @guest
        <ul class="login_buttons st_flex flex general_header_inner">
            <li><a class="login_button" href="{{url('/login')}}">ログイン</a></li>
            <li><a class="register_button" href="{{url('/register')}}">新規登録</a></li>
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


    <main class="main app_main">
        @yield('content')
    </main>
    </div>
    <!-- Scripts -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    @vite( ['resources/js/app.js','resources/js/preview.js','resources/js/post.js'])

</body>