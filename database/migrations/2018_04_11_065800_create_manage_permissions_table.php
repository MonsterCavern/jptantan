<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateManagePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->integer('id', true)->comment('系統流水號');
            $table->string('name', 50)->unique()->comment('管理許可名稱');
            $table->string('slug', 50)->comment('標示');

            $table->string('method')->nullable()->comment('請求類型');
            $table->text('path')->nullable()->comment('路由對象');
            // $table->string('prefix', 16)->default('')->comment('路由前綴');
            
            $table->integer('read_only')->default(0)->comment('唯讀,0:No,1:Yes');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('更新時間');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('建立時間');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
