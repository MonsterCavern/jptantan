<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
    #        $table->bigIncrements('id');
    #        $table->timestamps();
             $table->bigincrements('id');
             $table->string('name', 32)->comment('姓名');
             $table->string('email',255)->comment('電子信箱');
             $table->text('content')->comment('回報內容');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
