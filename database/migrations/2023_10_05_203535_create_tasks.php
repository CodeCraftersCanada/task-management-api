<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('description');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->bigInteger('task_status_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('tasks', function($table) {
            $table->foreign('task_status_id')->references('id')->on('user_type');
            $table->foreign('user_role_id')->references('id')->on('user_role');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
