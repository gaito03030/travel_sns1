@extends('layouts.general')
@section('content')
<h2>検索</h2>
    <form action="{{route('post_search_result')}}" method="get">
        <input type="text" name="search_text" placeholder="フリーワード検索"><br>
        絞り込み条件<br>
        [エリア]<br>
        @foreach($prefs as $pref)
        <label>
            <input type="radio" name="checked_pref" value="{{$pref->id}}">{{$pref->name}}
        </label>
        @endforeach
        <br>
        [カテゴリー]<br>
        @foreach($categorys as $category)
        <label>
            <input type="radio" name="checked_category" value="{{ $category->id }}">{{ $category->category }}
        </label>
        @endforeach
        <br>
        [予算]<br>
        ￥<input type="text" name="price_min"  placeholder="最低:制限なし" inputmode="numeric" pattern="^[1-9][0-9]*$" title="自然数で入力してください"> ~
        <input type="text" name="price_max" placeholder="最大:制限なし" inputmode="numeric" pattern="^[1-9][0-9]*$" title="自然数で入力してください">
        <br>
        <input type="submit" value="検索">
    </form>
@endsection