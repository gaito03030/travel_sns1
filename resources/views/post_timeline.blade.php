 @extends('layouts.general')

 @section('content')
 <!-- ここからがページごとの表示部分 -->
 <section class="main_header flex">
     <h2>急上昇</h2>
 </section>
 <div id="slider_top">
     <div class="slider">
         @foreach($items as $item)
         <a href="{{ url('/posts/'.$item->id) }}" class="slider_info">
             <div class="img_overflow_fide">
                 <img src="{{asset($item->main_img_url)}}" alt="">
             </div>
             <div class="title">
                 <p>{{$item->title}}</p>
             </div>
         </a>
         @endforeach
     </div>
 </div>
 <div class="header_inner flex">
     <div id="content_main" class="article_wrap">
         @foreach($items as $item)
         <a href="{{ url('/posts/'.$item->id) }}">
             <article class="article">
                 <figure>
                     <img src="{{asset($item->main_img_url)}}">
                     <span class="article-category">{{ $item->category->category }}</span>
                 </figure>
                 <div class="article-info">
                     <h3>{{$item->title}}</h3>
                     <div class="article_title_bottom flex flex_center">
                         <div class="img_cover_circle general_user_icon">
                             <img src="{{ $item->user->icon_url}}" width="50px" height="50px">
                         </div>
                         <p class="user_name">{{$item->user->name}}</p>
                         <div class="flex flex_center location_wrap">
                             <span class="material_fill material-symbols-outlined">
                                 pin_drop
                             </span>
                             <p>{{ $item->pref->name}}</p>
                         </div>
                         @if(!empty($item->created_at))
                         <time class="article-date">{{ $item->created_at->format('Y/m/d') }}</time>
                         @endif
                     </div>
                     <div class="desc_wrap">
                         <p>{{$item->description}}</p>
                         <div class="article_counts flex">
                             <p class="flex flex_center"><span class="material-symbols-outlined">
                                     favorite
                                 </span>{{$item->like_users_count}}</p>
                             <p class="flex flex_center"><span class="material-symbols-outlined">
                                     bookmark
                                 </span>{{$item->bookmark_users_count}}</p>
                             <p class="flex flex_center"><span class="material-symbols-outlined">
                                     tooltip
                                 </span>{{$item->comments_count}}</p>
                         </div>
                     </div>
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