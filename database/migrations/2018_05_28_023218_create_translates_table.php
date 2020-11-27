<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translates', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('*編號');
            $table->integer('target_id')->comment('*翻譯目標ID');
            $table->string('target_type')->comment('*翻譯目標類型');

            $table->integer('user_id')->comment('*翻譯者');
            $table->jsonb('content')->nullable()->comment('翻譯內容, 依照段落分割');
            $table->jsonb('tags')->nullable()->comment('標籤');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translates');
    }
}
