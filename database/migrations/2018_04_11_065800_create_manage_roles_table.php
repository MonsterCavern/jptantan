<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateManageRolesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique()->comment('唯一名稱');
            $table->string('slug', 50)->comment('標示, 標示相同代表規格合併');
            
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('更新時間');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('建立時間');
        });
        
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->integer('id', true)->comment('ID');
            $table->integer('permission_id');
            $table->integer('role_id');
            $table->index(['permission_id','role_id']);
            
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('更新時間');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('建立時間');
        });
        
        Schema::create('role_admins', function (Blueprint $table) {
            $table->integer('id', true)->comment('ID');
            $table->integer('admin_id');
            $table->integer('role_id');
            $table->index(['admin_id','role_id']);
            
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('更新時間');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('建立時間');
        });
        
        Schema::create('role_users', function (Blueprint $table) {
            $table->integer('id', true)->comment('ID');
            $table->integer('user_id');
            $table->integer('role_id');
            $table->index(['user_id','role_id']);
            
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
        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_permissions');
        Schema::dropIfExists('role_admins');
        Schema::dropIfExists('role_users');
    }
}
