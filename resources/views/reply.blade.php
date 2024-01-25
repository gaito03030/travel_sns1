<!DOCTYPE html>
<html lang="ja">
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

@extends('layouts.general')
@section('content')
    <h2>コメントに返信</h2>
    <form action="{{ route('reply.store') }}" method="post">
        @csrf
        <input type="hidden" value="{{ $post_id }}" name="post_id">
        <input type="hidden" value="{{ $comment_id }}" name="comment_id">
        <textarea rows="5" name="detail"></textarea><br>
        <input type="submit" class="button">
    </form>
@endsection