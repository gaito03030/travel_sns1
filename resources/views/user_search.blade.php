@extends('layouts.general')
@section('content')
<h2>検索</h2>
<form action="{{route('post_search_result')}}" method="get">
    <div class="flex st_flex flex_center">
        <input type="text" name="search_text" placeholder="フリーワード検索"><br>
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
            <option value="{{ $pref -> id }}">{{ $pref->name }}</option>
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
        <div class="flex st_flex popup_buttons">
            <button class="button js_popup_cancel_btn">閉じる</button>
            <input type="submit" class="button" value="検索"></input>
        </div>
    </div>
</form>
@endsection