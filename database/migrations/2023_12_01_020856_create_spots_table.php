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
        Schema::create('spots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts')->comment('投稿ID');
            $table->string('title')->comment('タイトル');
            $table->integer('date')->comment('〇日目');
            $table->time('time')->comment('時間');
            $table->text('description')->comment('詳細');
            $table->string('address')->comment('住所');
            $table->text('icon')->comment('アイコン');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spots');
    }
};
