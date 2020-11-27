<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_api', function (Blueprint $table) {
            $table->bigIncrements('id', true)->comment('ID');
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedInteger('code')->comment('狀態碼');
            $table->string('remote_addr', 128);

            $table->longText('params');
            $table->string('method', 16);
            $table->text('uri');
            $table->text('name')->nullable();

            $table->integer('own_id')->comment('寫入者ID');
            $table->string('own_type', 16)->comment('寫入者類型');

            $table->longText('response');
            $table->unsignedDecimal('response_time', 8, 4)->default(0);
            $table->text('user_agent');
            $table->text('header');
        });

        Schema::create('logs_err', function (Blueprint $table) {
            $table->bigIncrements('id', true)->comment('ID');
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('exception');
            $table->text('message');
            $table->text('file');
            $table->integer('line');
            $table->jsonb('trace');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs_api');
        Schema::dropIfExists('logs_err');
    }
}
