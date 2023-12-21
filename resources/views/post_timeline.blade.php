<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/post_timeline.css') }}">
    @vite('resources/css/post_timeline.css')
</head>

<body>
    <header id="header">
        <h1><a href="index.html">logo</a></h1>
    </header>
    <div class="flex">
        <nav class="main_nav">
        <div class="nav_myinfo">
                <div class="img_cover_circle">
                </div>
                <div class="myinfo_text">
                    {{-- <p class="my_name">XXXXX旅館</p> --}}
                    <p class="my_name">XXXX</p>
                    <p class="followers">000</p>
                    <p class="followers_title">followers</p>
                </div>
            </div>
            <ul class="nav">
                <li><a href="{{ url('/timeline') }}">ホーム</a></li>
                <li><a href="{{ url('/search') }}">検索</a></li>
                <li><a href="#">マイページ</a></li>
                <li><a href="{{ url('/notification') }}">通知</a></li>
                <li><a href="{{url('/logout')}}">ログアウト</a></li>
            </ul>
        </nav>
        <main class="main">
            <!-- ここからがページごとの表示部分 -->
            <div class="main_wrap">
            <section class="main_header flex">
                <h2>モデルコース一覧
                </h2>
                
            </section>
            <div id="slider_top">
                <div class="slider">
                @foreach($item as $items)
                    <div class="slider_info">
                        <img src="{{asset($items->main_img_url)}}" alt="">
                            <div class="title">
                                <p>{{$items->title}}</p>
                            </div>
                    </div>
                @endforeach
                </div>
            </div>
            <div class="header_inner flex">
                    <div id="content_main">
                        @foreach($item as $items)
                        <a href="{{ url('/posts/'.$items->id) }}">
                        <article class="article">
                            <figure>
			                    <img src="{{asset($items->main_img_url)}}" >
		                    </figure>
                            <div class="article-info">
                                <h1>{{$items->title}}</h1>
                                <span class="article-category">{{$items->category}}</span>
                                <time class="article-date">{{$items->created_at}}</time>
                                <p>{{$items->description}}</p>
                            </div>
                        </article>
                        </a>
                        @endforeach
                    </div> 
                </div>
            <div class="main_content">
                <div class="courses">
                    <section class="course"></section>
                </div>
            </div>
        </div>
        </main>
    </div>

</body>

</html>