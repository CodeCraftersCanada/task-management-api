<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_task', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->bigInteger('task_id')->unsigned();
            $table->tinyInteger('task_status_id')->default(1);
            $table->decimal('task_hours', 8, 2)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('sub_task', function($table) {
            $table->foreign('task_id')->references('id')->on('task');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_task');
    }
}
