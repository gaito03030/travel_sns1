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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('ユーザー名');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable()->comment('メールアドレス認証用？');
            $table->string('password',255)->comment('パスワード');
            $table->string('icon_url',255)->comment('アイコン画像のURL');
            $table->string('company_flg', 64)->comment('企業ユーザか一般ユーザか判別するためのフラグ');
            $table->text('bio')->nullable()->comment('自己紹介');
            $table->string('web_url')->nullable()->comment('webサイトのURL');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
