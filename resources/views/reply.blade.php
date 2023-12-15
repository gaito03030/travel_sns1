<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>コメントに返信</h2>
    <form action="{{ route('reply.store') }}" method="post">
        @csrf
        <input type="hidden" value="{{ $post_id }}" name="post_id">
        <input type="hidden" value="{{ $comment_id }}" name="comment_id">
        <textarea rows="5" name="detail"></textarea><br>
        <input type="submit">
    </form>
</body>
</html>