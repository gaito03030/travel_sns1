@extends('layouts.company')

@section('content')
    <h2>マイページ</h2>
    <p>{{$user->name}}</p>
    <img src="{{ asset($user->icon_url)}}" width="100px" height="100px">
    <p>BIO:
        @if(isset($user->bio)){{$user->bio}}
        @else 自己紹介を設定してください
        @endif</p>
    <h3>ブックマーク:{{$bookmarks_count}}件</h3>
    @if($bookmarks_count > 0))
    @foreach($bookmarks as $bookmark)
    <p>{{$bookmark->title}}</p>
    @endforeach
    @else
    <P>ブックマークが登録されていません</P>
    @endif
    @endsection