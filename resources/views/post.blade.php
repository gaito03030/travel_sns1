<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Post</h2>
    <p>id:{{$post->id}}</p>
    <p>title:{{$post->title}}</p>
    <p>main_img_url:{{$post->main_img_url}}</p>
    <p>description:{{$post->description}}</p>
    <h2>user</h2>
    <p>user_id:{{$post->user->id}}</p>
    <p>user_id:{{$post->user->name}}</p>
    <p>user_id:{{$post->user->icon_url}}</p>
    <h2>category</h2>
    <p>category:{{$post->category->category}}</p>
    <h2>pref</h2>
    <p>pref:{{$post->pref->name}}</p>
    <h2>details</h2>
    @foreach($post->details as $detail)
        <h4>title:{{$detail->title}}</h4>
        <p>content:{{$detail->content}}</p>
    @endforeach
    <h2>spots</h2>
    @foreach($post->spots as $spot)
        <h4>title:{{$spot->title}}</h4>
        <p>description:{{$spot->description}}</p>
        <p>address:{{$spot->address}}</p>
    @endforeach

</body>
</html>