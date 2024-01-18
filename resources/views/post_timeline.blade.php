 @extends('layouts.general')

 @section('content')
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
@endsection