<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="manifest" href="/manifest.json">
    <style>
        .follow_contents {
            border: solid 1px;
            border-color: #ccc;
        }
    </style>
</head>

<body>

    @extends('layouts.general')
    @section('content')
        @foreach ($followedCompanies as $company)
        <p class="follow_contents">
            <div class="img_overflow_fide">
                <img src="{{ asset($company->icon_url) }}" alt="">
            </div>
            <p >{{ $company->name }}</p>
            <button><a href="{{route('follow_remove',['id'=> $company->id])}}">フォローを外す</a></button>
        </p>
            <!-- 他の企業情報の表示 -->
        @endforeach
    @endsection

</body>

</html>
