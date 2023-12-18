</html>


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" rel="stylesheet">
    {{-- <link href="css/style.css" rel="stylesheet" > --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .number_group {
            display: flex;
        }

        .number {
            padding-right: 20px;
        }

        .open {
            cursor: pointer;
        }

        #pop-up {
            display: none;
        }

        .overlay {
            display: none;
        }

        #pop-up:checked+.overlay {
            display: block;
            position: fixed;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            z-index: 9999;
            background: rgba(0, 0, 0, 0.6);
        }

        .window {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 90vw;
            max-width: 360px;
            padding: 20px;
            height: 300px;
            background-color: #fff;
            border-radius: 4px;
            align-items: center;
            transform: translate(-50%, -50%);
        }

        .close {
            position: absolute;
            top: 4px;
            right: 4px;
            cursor: pointer;
        }
    </style>

</head>

<body>


    <header id="header">
        <h1><a href="index.html">logo</a></h1>
    </header>
    <div class="flex">
        <nav class="main_nav">
            <div class="nav_myinfo">
                <div class="img_cover_circle">
                    <img src="" width="50px" height="50px">
                </div>
                <div class="myinfo_text">
                    {{-- <p class="my_name">XXXXX旅館</p> --}}
                    <p class="my_name">{{ $userName }}</p>
                    <p class="followers">000</p>
                    <p class="followers_title">followers</p>
                </div>
            </div>
            <ul class="nav">
                <li><a href="{{ url('/company_mypage') }}"><img src="img/home.png" width="26px">ホーム</a></li>
                <li><a href="{{ url('/create') }}"><img src="img/create.png" width="26px">新規作成</a></li>
                <li><a href="{{ url('/management_company') }}"><img src="img/mypage.png" width="26px">マイ企業情報管理</a></li>
                <li><a href="{{ url('/notification') }}"><img src="img/alert.png" width="26px">通知</a></li>
                <li><a href="{{ url('/logout') }}">ログアウト</a></li>
            </ul>
        </nav>
        <main class="main">
            <!-- ここからがページごとの表示部分 -->
            <section class="main_header flex">
                <h2>マイモデルコース</h2>
                <div class="header_inner flex">
                    <form class="search_wrap" action="{{ route('company_mypage.posts') }}" method="get">
                        <input class="input_search" type="search" placeholder="検索" name="search" value="{{ request('search') }}">
                        <button type="submit" class="search_button">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </form>
                    <button class="js_add_button create_button button">＋ 新規追加</button>
                </div>
            </section>
            <div class="main_content">
                <main class="py-4">
                    @yield('content')


                    @foreach ($myPosts as $post)
                    <div class="mymodel">
                        <p><img src="{{ asset('storage/' . $post->main_img_url) }}" width="300px" height="200px" alt="main_imag_url"></p>
                        <p class="travel_title">{{ $post->title }}</p>
                        <p class="travel_status"><?php
                                                    if ($post->status !== 1) {
                                                        echo '非公開中';
                                                    } else {
                                                        echo '公開中';
                                                    }
                                                    ?></p>
                        <p>{{ $post->description }}</p>
                        <!-- 他の投稿情報を表示する -->

                        <label class="open" for="pop-up">削除</label>
                        <input type="checkbox" id="pop-up">
                        <div class="overlay">
                            <div class="window">
                                <label class="close" for="pop-up">閉じる</label>
                                <form method="POST" action="{{ route('company_mypage.delete', $post->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">はい</button>
                                </form>

                                <p><a href="company_mypage?">いいえ</a></p>
                            </div>
                        </div>
                        <a href="index.php">編集</a>
                    </div>

                    <hr>
                    @endforeach
                </main>
                <div class="courses">
                    <section class="course"></section>
                </div>
            </div>
        </main>
    </div>

</body>

</html>