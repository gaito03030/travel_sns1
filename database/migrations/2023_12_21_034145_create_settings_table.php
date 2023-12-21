<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('notice_reply_flg')->default(1)->comment('一般ユーザからの返信を通知するフラグ');
            $table->boolean('notice_poster_reply_flg')->default(1)->comment('投稿主からの返信を通知するフラグ');
            $table->boolean('notice_comment_flg')->default(1)->comment('投稿へのコメントの通知フラグ');
            $table->boolean('notice_like_flg')->default(1)->comment('投稿へのいいね通知フラグ');
            $table->boolean('notice_follow_flg')->default(1)->comment('フォロー通知フラグ');
            $table->boolean('notice_bookmark_flg')->default(1)->comment('ブックマーク通知フラグ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
