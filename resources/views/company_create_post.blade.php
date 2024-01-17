@extends('layouts.company')

@section('content')
<div class="main_bg">
    <section class="main_header create_post_header flex">
        <h2>モデルコース作成</h2>
        <div class="header_inner flex">
            <button class="js_confirm_button button create_button">保存</button>
        </div>
    </section>
    <form action="{{ route('create.store') }}" class="post_form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="js_modal_background modal_back"></div>
        <div class="js_modal_widow confirm_wrap">
            <h3>保存</h3>
            公開状況の設定<br>
            <div class="flex confirm_content status_wrap">
                <label class="radio_label"><input type="radio" name="status" value="0">非公開</label>
                <label class="radio_label"><input type="radio" name="status" value="1">公開</label>
            </div>
            <input type="file" name="main_image"><br>
            カテゴリーを一つ選択<br>
            <div class="flex confirm_content category_wrap">
                @foreach($datas['category'] as $category)
                <label class="radio_label"><input type="radio" name="category" value="{{$category->id}}">{{ $category->category }}</label>
                @endforeach<br>
            </div>
            <label for="pref">県を選択</label><br>
            <select name="pref" class="input_pref confirm_content" id="pref">
                @foreach($datas['pref'] as $pref)
                <option value="{{ $pref -> id }}">{{ $pref->name }}</option>
                @endforeach
            </select>
            <br>
            予算<br>
            <div class="confirm_content">
                <input type="text" name="price" inputmode="numeric" placeholder="予算を入力" pattern="^[0[[1-9][0-9]*]]$" title="自然数で入力してください" required>
            </div>
            <div class="flex button_wrap">
                <input type="button" class="button return_button js_modal_close_button" value="戻る">
                <input type="submit" class="button" value="登録">
            </div>
        </div>
        <div class=" form_group">
            <div class="input_title_wrap">
                <input type="text" class="input_title" name="title" placeholder="タイトル" title="入力必須です" required>
            </div>
            <div class="form_content">
                <label class="label" for="description">概要</label>
                <textarea name="description" rows="4" placeholder="概要" title="入力必須です" required></textarea>
            </div>
            <div class=" form_content">
                <h3>詳細</h3>
                <div class="js_items">
                    <ul class="js_item_list" data-input="details">
                        <li class="js_item form_box">
                            <input type="text" name="detail_title[0]" class="js_input form_child" placeholder="タイトル（例 持ち物リスト）">
                            <textarea type="text" name="detail_content[0]" class="js_input form_child" placeholder="内容" rows="3"></textarea>
                            <button class="js_remove_btn remove_button" title="削除">×</button>
                        </li>
                    </ul>
                    <button class="js_add_btn add_btn button">詳細を追加</button>
                </div>
            </div>
        </div>
        <div class="form_group">
            <h3>コース</h3>
        </div>
        <div class="js_items">
            <input type="hidden" class="js_date_length" name="date_length" value="1">
            <ul class="js_item_list input_course" data-input="dates">
                <li class="js_item input_date course_bg">
                    <div class="form_group date_wrap">
                    <p class="js_date_text form_group date_text">1日目</p>
                        <div class="js_items form_content">
                            <ul class="js_item_list" data-input="spots">
                                <li class="js_item flex form_box flex_form_box">
                                    <div class="input_flex_left">
                                        <input type="time" name="spot_time_1[0]" class="js_input">
                                    </div>

                                    <div class="input_flex_right">
                                        <input type="text" name="spot_title_1[0]" class="js_input" placeholder="行程のタイトル">
                                        <textarea name="spot_description_1[0]" class="js_input" placeholder="詳細" rows="3"></textarea>
                                        <input type="text" name="spot_address_1[0]" class="js_input" placeholder="住所">
                                    </div>
                                    <button class="js_remove_btn remove_button">×</button>
                                </li>
                            </ul>
                            <button class="js_add_btn add_btn button ">予定を追加</button>
                        </div>
                        <button class="js_remove_btn remove_button remove_date">日にちを削除</button>
                    </div>
                </li>
            </ul>
            <button class="js_add_btn add_btn button">日にちを追加</button>
        </div>
    </form>
</div>
@endsection