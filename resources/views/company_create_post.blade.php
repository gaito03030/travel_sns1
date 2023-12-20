<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>モデルコース投稿</h1>
    <form action="{{ route('create.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="status">
            <input type="hidden" name="status" value="0">
            <input type="checkbox" id="status" name="status" value="1">
            公開する<br>
        </label>
        <input type="file" name="main_image"><br>
        カテゴリーを選択<br>
        @foreach($datas['category'] as $category)
        <label><input type="radio" name="category" value="{{$category->id}}">{{ $category->category }}</label>
        @endforeach<br>
        <label for="pref">県を選択</label>
        <select name="pref" id="pref">
            @foreach($datas['pref'] as $pref)
            <option value="{{ $pref -> id }}">{{ $pref->name }}</option>
            @endforeach
        </select>
        <br>
        予算:<input type="text" name="price" inputmode="numeric" pattern="^[1-9][0-9]*$" title="自然数で入力してください" required>
        タイトル:<input type="text" name="title" placeholder="タイトル" title="入力必須です" required><br>
        概要：<textarea name="description" placeholder="概要" title="入力必須です" required></textarea><br>
        <h3>詳細</h3>
        <div class="js_items">
            <ul class="js_item_list" data-input="details">
                <li class="js_item">
                    <input type="text" name="detail_title[0]" class="js_input" placeholder="タイトル（例 持ち物リスト）"><br>
                    <textarea type="text" name="detail_content[0]" class="js_input" placeholder="内容"></textarea>
                    <button class="js_remove_btn">削除</button><br>

                </li>
            </ul>
            <button class="js_add_btn">詳細を追加</button><br>
        </div>

        <h3>コース</h3>
        <div class="js_items">
            <input type="hidden" class="js_date_length" name="date_length" value="1">
            <ul class="js_item_list" data-input="dates">
                <li class="js_item">
                    <p class="js_date_text">1日目</p>
                    <div class="js_items">
                        <ul class="js_item_list" data-input="spots">
                            <li class="js_item">
                                <input type="time" name="spot_time_1[0]" class="js_input">
                                <input type="text" name="spot_title_1[0]" class="js_input" placeholder="行程のタイトル">
                                <textarea name="spot_description_1[0]" class="js_input" placeholder="詳細"></textarea>
                                <input type="text" name="spot_address_1[0]" class="js_input" placeholder="住所"><br>
                                <button class="js_remove_btn">削除</button>
                            </li>
                        </ul>
                        <button class="js_add_btn">予定を追加</button><br>
                    </div>
                    <button class="js_remove_btn">日にちを削除</button>
                </li>
            </ul>
            <button class="js_add_btn">日にちを追加</button><br>
        </div>

        <input type="submit" value="登録">
    </form>
    <a href="{{ url('/logout') }}">ログアウト</a>
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/post.js') }}"></script>
</body>

</html>