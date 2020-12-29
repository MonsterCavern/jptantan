<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWenku8sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wenku8s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('標題');
            $table->string('author')->comment('作者');
            $table->string('url')->comment('網址');
            $table->string('publishing')->comment('出版社');
            $table->text('description')->nullable()->comment('簡介');
            $table->integer('word_length')->nullable()->comment('字數');

            $table->string('status')->default('連載中')->comment('狀態');
            $table->timestamp('lasted_at')->nullable()->comment('最後更新時間');
            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wenku8s');
    }
}
