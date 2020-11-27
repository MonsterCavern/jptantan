<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->integer('id', true)->comment('系統帳號ID');
            $table->string('account', 64)->unique('admin_account')->comment('管理者帳號');
            $table->string('password')->comment('密碼');
            $table->integer('type')->default(1)->comment('管理者身份 0:SuperAdmin,1:default');
                        
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('更新時間');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('建立時間');
            $table->softDeletes()->comment('刪除時間');
            
            $table->text('token')->nullable()->comment('管理者Token');
        });
            
        Schema::create('admin_groups', function (Blueprint $table) {
            $table->integer('id', true)->comment('ID');
            $table->string('name', 32)->comment('名稱');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('更新時間');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('建立時間');
        });
        
        Schema::create('admin_group_admins', function (Blueprint $table) {
            $table->integer('id', true)->comment('ID');
            $table->integer('group_id')->comment('群組ID');
            $table->integer('admin_id')->comment('管理帳號ID');
            $table->index(['group_id', 'admin_id']);
            
            $table->integer('perm')->default(1)->comment('權限大小 0:root,1:default');
                        
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('更新時間');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('建立時間');
            $table->softDeletes()->comment('刪除時間');
        });
            
        Schema::create('admin_operation_logs', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('建立時間');
            $table->integer('admin_id');
            $table->string('path');
            $table->string('method', 10);
            $table->string('ip', 15);
            $table->text('input');
            
            $table->index('admin_id');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
        Schema::dropIfExists('admin_groups');
        Schema::dropIfExists('admin_group_admins');
        Schema::dropIfExists('admin_operation_logs');
    }
}
