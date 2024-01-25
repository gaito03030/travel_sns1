<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="manifest" href="/manifest.json">
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/serviceworker.js').then(function() {
                console.log("Service Worker is registered!!");
            });
        }
    </script>
</head>
<body>
    
    <?php 
        echo $id;?>
    <div class="anser">
        <p>本当に削除しますか？</p>
        <a href="{{route('company_mypage.delete.exe',['id' => $id])}}">はい</a>
        <a href="{{route('company_mypage')}}">いいえ</a>
    </div>
    
</body>
</html>