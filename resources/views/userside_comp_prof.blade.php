<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/userside_comp_prof.css') }}">
    @vite('resources/css/userside_comp_prof.css')

</head>

<body>
    <header id="header">
        <h1><a href="index.html">logo</a></h1>
    </header>
    <div class="flex">
        <nav class="main_nav">
            <div class="nav_myinfo">
                <div class="img_cover_circle">
                    <img src="./image/icon_default.png" width="50px" height="50px">
                </div>
                <div class="myinfo_text">
                    <p class="my_name">XXXXX旅館</p>
                    <p class="followers">000</p>
                    <p class="followers_title">followers</p>
                </div>
            </div>
            <ul class="nav">
                <li><a href="index.html">ホーム</a></li>
                <li><a href="index.html">新規作成</a></li>
                <li><a href="index.html">マイ企業情報管理</a></li>
                <li><a href="index.html">通知</a></li>
                <li><a href="{{ url('/logout') }}">ログアウト</a></li>
            </ul>
        </nav>
        <main class="main">
            <!-- ここからがページごとの表示部分 -->
            <section class="main_header flex">
                <article class="article">
                    <article class="users">
                        <img src="{{asset('storage/travel1.jpg')}}" >
                        <section class="user_info">
                            <h1>{{$company->name}}</h1>
                            <ul>
                                <li class="follower_num">
                                    123
                                </li>
                                <li class="bookmarks_num">
                                    9876
                                </li>                                        
                            </ul>
                            <div class="article-info">   
                                <p>{{$company->bio}}</p>                             
                                <a href="{{$company->web_url}}" class="user_url">{{$company->web_url}}</a>
                            </div>
                        </section>
                        <button>followする</button> 
                        <a href="{{route('general.mypage.edit',['user_info'=> $company])}}">
                        編集する</a>                               
                    </article>
                    <article class="posts">
                        @foreach($company->posts as $companys)
                        <div class="slider">
                            <img src=" {{asset($companys->main_img_url)}} ">
                            <p>{{$companys->title}}</p>
                        </div>
                        @endforeach
                    </article>
                            
                </article>
            </section>
    </div>

</body>

</html>