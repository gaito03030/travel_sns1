<head>
    <link rel="manifest" href="/manifest.json">
</head>

@extends('layouts.general')

@section('content')
<!-- ここからがページごとの表示部分 -->
<section class="main_header flex">
    <h2>プロフィール編集</h2>
</section>
@yield('content')
<div class="main_content">
    <form class="user_info_edit_form" action="{{ route('general_edit.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex user_info_wrap">
            <div class="icon_wrap">
                <img id="img_prv" src="{{asset($user_info->icon_url)}}">
                <label class="file_label">
                    アイコン画像を変更
                    <input id="img_upload" type="file" accept="image/*" name="img_path">
                </label>
            </div>
            <div class="user_info">
                <label class="label" for="name">名前</label>
                <input type="text" id="name" name="name" value="{{ $user_info->name }}" placeholder="名前" required>
                <br>
                <label class="label" for="bio">ひとこと</label>
                <textarea rows="4" name="bio" @if(strlen($user_info->bio) > 0)value="{{ $user_info->bio }}"@endif placeholder="自己紹介を入力してください"></textarea>
                <input type="submit" class="button" value="変更を保存">
            </div>
        </div>
    </form>
</div>
@endsection