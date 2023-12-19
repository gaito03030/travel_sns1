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
                    <img src="{{ asset($user_info->icon_url) }}" width="50px" height="50px">
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
                        
                        <img src=" {{asset('storage/'.$user_info->icon_url)}}
                        "width="200px"
                            height="200px" alt="User Icon">
                        <?php
                        //企業の名前表示
                        $user_name = $user_info->name;
                        //企業のひとこと(bio)
                        $user_bio = $user_info->bio;
                        //公式ホームページURL
                        $user_url = $user_info->web_url;
                        //userのアイコンを取得
                        $user_icon = $user_info->icon_url;
                        echo '<h3>' . $user_name . '</h3>';
                        echo '<br>';
                        echo '<div class=number_group>
                                                                                                                                 <p class=number>公開中の投稿' .
                            $posts_number .
                            '件</p>  ';
                        echo '<p class=number>お気に入り X件</p>  ';
                        echo '<p class=number>総ブックマーク X件</p> </div> ';
                        echo '<br>';
                        echo 'ひとこと' . '<br>';
                        echo $user_bio;
                        echo '<br>';
                        echo '公式ホームページURL';
                        echo '<br>';
                        echo $user_url;
                        
                        ?>

                        <div><a href="{{ route('user_edit') }}">変更</a></div>

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
