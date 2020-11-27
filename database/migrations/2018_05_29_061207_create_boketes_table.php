<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoketesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boketes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number')->comment('*編號');
            $table->text('url')->nullable()->comment('連結');
            $table->json('content')->nullable()->comment('內文');
            $table->integer('ranting')->nullable()->comment('評價');
            $table->text('source')->nullable()->comment('來源');
            $table->text('image')->nullable()->comment('圖片');
            $table->integer('is_updated')->default(0)->comment('更新狀態:0:未更新,1:已更新	');

            $table->timestamp('released_at')->nullable()->comment('發布時間');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();

            $table->integer('google_translate_id')->nullable()->comment('Google Robot');
            $table->integer('baidu_translate_id')->nullable()->comment('Baidu Robo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boketes');
    }
}
