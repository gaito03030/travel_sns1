@extends('layouts.general')
@section('content')
<!-- ここからがページごとの表示部分 -->
<h2>検索結果</h2>
    <form action="{{route('post_search_result')}}" method="get">
        <div class="flex flex_center">
            <input type="text" name="search_text" @if(!empty($return->narrow->search_text)) value="{{$return->narrow->search_text}}" @endif placeholder="フリーワード検索"><br>
            <input type="submit" class="button search_submit" value="検索">
            <div class="post_buttons">
                <a href="#" class="narrow_button js_open_narrow_popup"><span class="material-symbols-outlined">
                        filter_list
                    </span><br></a>
            </div>
        </div>
        <div class="js_bg">
        </div>
        <div class="js_popup popup">
            絞り込み条件<br>
            [エリア]<br>
            <select name="checked_pref" class="input_pref confirm_content" id="pref">
                <option value="-1" selected>選択なし</option>
                @foreach($prefs as $pref)
                <option value="{{ $pref -> id }}">{{ $pref['name'] }}</option>
                @endforeach
            </select>
            <br>
            [カテゴリー]<br>
            @foreach($categorys as $category)
            <label>
                <input type="radio" name="checked_category" value="{{ $category->id }}">{{ $category->category }}
            </label>
            @endforeach
            <br>
            [予算]<br>
            ￥<input type="text" name="price_min" placeholder="最低:制限なし" inputmode="numeric" pattern="^[1-9][0-9]*$" title="自然数で入力してください"> ~
            <input type="text" name="price_max" placeholder="最大:制限なし" inputmode="numeric" pattern="^[1-9][0-9]*$" title="自然数で入力してください">
            <br>
        </div>
    </form>
    @if($return['count'] >0 )
    <p>結果：{{$return['count']}}件</p>
    @else
    <p>条件に当てはまるコースはありません。</p>
    @endif
<div id="content_main" class="article_wrap">
    @foreach($return['posts'] as $item)
    <a href="{{ url('general/posts/'.$item->id) }}">
        <article class="article">
            <figure>
                <img src="{{asset($item->main_img_url)}}">
                <span class="article-category">{{ $item->category->category }}</span>
            </figure>
            <div class="article-info">
                <h3>{{$item->title}}</h3>
                <div class="article_title_bottom flex flex_center">
                    <div class="img_cover_circle general_user_icon">
                        <img src="{{ asset($item->user->icon_url)}}" width="50px" height="50px">
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
<div class="main_content">
    <div class="courses">
        <section class="course"></section>
    </div>
</div>
@endsection