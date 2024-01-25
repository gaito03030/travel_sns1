@extends('layouts.general')
@section('content')
<section class="main_header st_flex flex">
    <h2>フォロー企業一覧</h2>

</section>
<div class="main_content">
    <div class="follow_list">
        @foreach ($followedCompanies as $company)
        <div class="flex st_flex follow_list_item flex_center">
            <div class="flex st_none flex_center">
                <div class="img_cover_circle general_user_icon">
                    <img src="{{ asset($company->icon_url) }}" alt="">
                </div>
                <p>{{ $company->name }}</p>
            </div>
            <a href="{{url('general/user/'.$company->id)}}" class="st_block follow_link st_flex flex_center">
                <div class="img_cover_circle general_user_icon">
                    <img src="{{ asset($company->icon_url) }}" alt="">
                </div>
                <p>{{ $company->name }}</p>
            </a>
            <a class="button other_btn" href="{{route('follow_remove',['id'=> $company->id])}}"><span class="st_none">フォロー</span>解除</a>
        </div>

        <!-- 他の企業情報の表示 -->
        @endforeach
    </div>
</div>
@endsection