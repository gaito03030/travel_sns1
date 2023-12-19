<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>モデルコース編集</h1>
    <form action="{{ route('create.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="post_id" value="{{ $datas['post']->id }}" >
        <label for="status">
            <input type="hidden" name="status" value="0">
            @if($datas['post']->status == '1')
            <input type="checkbox" id="status" name="status" checked value="1">
            @else
            <input type="checkbox" id="status" name="status" value="1">
            @endif
            公開する<br>
        </label>
        <input type="file" name="main_image"><br>
        カテゴリーを選択<br>
        @foreach($datas['category'] as $category)
        @if($category->id == $datas['post']->category_id)
        <label><input type="radio" checked name="category" value="{{$category->id}}">{{ $category->category }}</label>
        @else
        <label><input type="radio" name="category" value="{{$category->id}}">{{ $category->category }}</label>
        @endif
        @endforeach<br>
        <label for="pref">県を選択</label>
        <select name="pref" id="pref">
            @foreach($datas['pref'] as $pref)
            @if($pref->id == $datas['post']->pref_id)
            <option selected value="{{ $pref -> id }}">{{ $pref->name }}</option>
            @else
            <option value="{{ $pref -> id }}">{{ $pref->name }}</option>
            @endif
            @endforeach
        </select>
        <br>
        タイトル:<input type="text" name="title" value="{{ $datas['post']->title }}" placeholder="タイトル"><br>
        概要：<textarea name="description" placeholder="概要">{{ $datas['post']->description }}</textarea><br>
        <h3>詳細</h3>
        <div class="js_items">
            <ul class="js_item_list" data-input="details">
                <?php
                $counter = 0;
                ?>
                @foreach($datas['post']->details as $detail)
                <li class="js_item">
                    <input type="text" name="detail_title[{{ $counter }}]" class="js_input" value="{{ $detail->title }}" placeholder="タイトル（例 持ち物リスト）"><br>
                    <textarea type="text" name="detail_content[{{ $counter }}]" class="js_input" placeholder="内容">{{$detail->content }}</textarea>
                    <button class="js_remove_btn">削除</button><br>
                </li>
                <?php
                $counter++;
                ?>
                @endforeach
            </ul>
            <button class="js_add_btn">詳細を追加</button><br>
        </div>

        <h3>コース</h3>
        <div class="js_items">
            <input type="hidden" class="js_date_length" name="date_length" value="1">
            <ul class="js_item_list" data-input="dates">
                @foreach($datas['spots'] as $key => $spots)
                <li class="js_item">
                    <p class="js_date_text">{{$key}}日目</p>
                    <div class="js_items">
                        <ul class="js_item_list" data-input="spots">
                            <?php $counter = 0; ?>
                            @foreach($spots as $spot)
                            <li class="js_item">
                                <input type="time" name="spot_time_{{$key}}[{{ $counter }}]" value="{{$spot['time']}}" class="js_input">
                                <input type="text" name="spot_title_{{$key}}[{{ $counter }}]" value="{{$spot['title']}}" class="js_input" placeholder="行程のタイトル">
                                <textarea name="spot_description_{{$key}}[{{ $counter }}]" class="js_input" placeholder="詳細">{{$spot['description']}}</textarea>
                                <input type="text" name="spot_address_{{$key}}[{{ $counter }}]" value="{{$spot['address']}}" class="js_input" placeholder="住所"><br>
                                <button class="js_remove_btn">削除</button>
                            </li>
                            <?php $counter++; ?>
                            @endforeach
                        </ul>
                        <button class="js_add_btn">予定を追加</button><br>
                    </div>
                    <button class="js_remove_btn">日にちを削除</button>
                </li>
                @endforeach
            </ul>
            <button class="js_add_btn">日にちを追加</button><br>
        </div>



        <input type="submit" value="登録">
    </form>
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <!--jsの読み込み-->
    @vite('resources/js/post.js')
</body>

</html>