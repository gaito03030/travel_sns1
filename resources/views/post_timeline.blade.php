 @extends('layouts.general')

 @section('content')
 <!-- ここからがページごとの表示部分 -->
 <section class="main_header flex">
     <h2>急上昇</h2>
 </section>
 <div id="slider_top">
     <div class="slider">
         @foreach($item as $items)
         <a href="{{ url('/posts/'.$items->id) }}" class="slider_info">
            <div class="img_overflow_fide">
             <img src="{{asset($items->main_img_url)}}" alt="">
            </div>
             <div class="title">
                 <p>{{$items->title}}</p>
             </div>
         </a>
         @endforeach
     </div>
 </div>
 <div class="header_inner flex">
     <div id="content_main" class="article_wrap">
         @foreach($item as $items)
         <a href="{{ url('/posts/'.$items->id) }}">
             <article class="article">
                 <figure>
                     <img src="{{asset($items->main_img_url)}}">
                     <span class="article-category">{{ $items->category->category }}</span>
                 </figure>
                 <div class="article-info">
                     <h1>{{$items->title}}</h1>
                     <div class=""></div>
                     <time class="article-date">@if(!empty($items->created_at)){{ $items->created_at->format('Y/m/d') }}@endif</time>
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
 @endsection