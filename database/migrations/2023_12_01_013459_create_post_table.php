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
        Schema::create('posts', function (Blueprint $table) {
            $table->id()->comment('投稿ID');
            $table->foreignId('user_id')->constrained('users')->comment('投稿者ユーザーID')->change();
            //$table->foreignId('category_id')->constrained('categorys')->comment('カテゴリーID')->change();
            $table->foreignId('category_id')->constrained('categories')->comment('カテゴリーID')->change();
            $table->string('title')->comment('タイトル');
            $table->string('main_img_url')->comment('メイン画像URL');
            $table->integer('status')->comment('公開状況(1=公開,0=非公開)');
            $table->foreignId('pref_id')->constrained('prefs')->comment('県ID')->change();
            $table->string('description')->comment('概要');
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
        Schema::dropIfExists('posts');
    }
};
