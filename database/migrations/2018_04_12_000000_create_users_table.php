<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('*編號');
            $table->string('name')->comment('*顯示名稱');
            $table->string('email')->unique()->comment('*電子信箱');
            $table->string('password');
            // $table->rememberToken();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
            $table->text('token')->nullable()->comment('*Token');
        });
        
        Schema::create('user_groups', function (Blueprint $table) {
            $table->integer('id', true)->comment('ID');
            $table->string('name', 32)->comment('名稱');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('更新時間');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('建立時間');
        });
    
        Schema::create('user_group_users', function (Blueprint $table) {
            $table->integer('id', true)->comment('ID');
            $table->integer('group_id')->comment('群組ID');
            $table->integer('user_id')->comment('管理帳號ID');
            $table->index(['group_id', 'user_id']);
        
            $table->integer('perm')->comment('權限大小 0:root,1:default');
                    
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('更新時間');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('建立時間');
            $table->softDeletes()->comment('刪除時間');
        });
        
        Schema::create('user_operation_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('建立時間');
            $table->integer('user_id');
            $table->string('path');
            $table->string('method', 10);
            $table->string('ip', 15);
            $table->text('input');
            
            $table->index('user_id');
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
        Schema::dropIfExists('user_groups');
        Schema::dropIfExists('user_group_users');
        Schema::dropIfExists('user_operation_logs');
    }
}
