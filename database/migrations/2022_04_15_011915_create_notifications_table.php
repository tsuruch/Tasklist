<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('model_id');
            $table->text('message');
            $table->string('route');
            $table->boolean('notificated')->default(false);
            $table->timestamps();
            $table->foreign('model_id')
            ->references('task_id')
            ->on('mytasks')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
