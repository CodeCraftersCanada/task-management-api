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
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('description');
            $table->bigInteger('task_status_id')->unsigned();
            $table->decimal('task_hours', 10, 2)->nullable();
            $table->decimal('unpaid_task_hours', 10, 2)->nullable();
            $table->decimal('paid_task_hours', 10, 2)->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('assigned_to')->unsigned();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('task', function($table) {
            $table->foreign('task_status_id')->references('id')->on('task_status');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('assigned_to')->references('id')->on('users');
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
