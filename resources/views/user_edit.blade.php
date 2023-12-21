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
                    <img src="{{asset($user_info->icon_url) }}" width="50px" height="50px">
                </div>
                <div class="myinfo_text">
                    {{-- <p class="my_name">XXXXX旅館</p> --}}
                    <p class="my_name">{{ $user_info->name }}</p>
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
                <h2>マイ企業管理情報</h2>
                <div class="header_inner flex">
                    <form class="search_wrap" action="{{ route('company_mypage.posts') }}" method="get">
                        <input class="input_search" type="search" placeholder="検索" name="search"
                            value="{{ request('search') }}">
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
                    <div>
                        <img src="{{asset($user_info->icon_url)}}"
                            width="200px"
                            height="200px" alt="User Icon">
                    
                        <label class="open" for="pop-up">画像を変更</label>
                        <input type="checkbox" id="pop-up">
                        <div class="overlay">
                            <div class="window">
                                <label class="close" for="pop-up">閉じる</label>
                                <h3>変更する画像を選択してください</h3>
                                <form action="{{route('user_edit.img',$user_info->id)}}" method="POST" enctype="multipart/form-data" >
                                    @csrf
                                    @method('PUT')
                                    <input type="file" name="img_path">
                                    <p><input type="submit" value="変更"></p>
                                </form>
                            </div>
                        </div>

                        <form action="{{ route('user_edit.store', $user_info->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <p>名前:<input type="text" name="name" value="{{ $user_info->name }}"></p>
                            <p>ひとこと:<input type="text" name="bio" value="{{ $user_info->bio }}"></p>
                            <p>公式ホームページURL:<input type="text" name="web_url" value="{{ $user_info->web_url }}"></p>
                            <p><input type="submit" value="変更"></p>
                        </form>



                    </div>
                </main>
                <div class="courses">
                    <section class="course"></section>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
