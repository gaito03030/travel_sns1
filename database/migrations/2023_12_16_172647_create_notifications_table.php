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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->comment('通知の送信先ユーザー');
            $table->text('type')->comment('通知タイプ「公開」「ブックマーク」「いいね」「コメント」「フォロー」');
            $table->text('body')->comment('通知本文');
            $table->text('url')->comment('ボタンのリンク先');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
