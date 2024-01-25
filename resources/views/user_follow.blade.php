<?php
echo $company_info->id;
echo $company_info->name;
echo $company_info->company_flg;
?>

<head>
    <link rel="manifest" href="/manifest.json">
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/serviceworker.js').then(function() {
                console.log("Service Worker is registered!!");
            });
        }
    </script>
</head>

<a href="{{ url('test_follow', ['id' => $company_info->id]) }}">フォローをする</a>
