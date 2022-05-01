<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

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
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token', 80)->unique()->nullable()->default(null)->comment('guardが参照するapi_token');
            $table->boolean('is_chatgroups_admin')->default(false)->comment('trueだとchatgroups管理権限を持つ');
            $table->boolean('is_tasks_admin')->default(false)->comment('trueだとtasks管理権限を持つ');
            $table->boolean('is_auth_admin')->default(false)->comment('trueだと権限管理権限を持つ');
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
