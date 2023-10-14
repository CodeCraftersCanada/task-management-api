<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('paid_to')->unsigned();
            $table->bigInteger('task_id')->unsigned();
            $table->tinyInteger('status_id')->default(1); //paid or not
            $table->decimal('total_hours', 8, 2)->nullable();
            $table->decimal('hourly_rate', 8, 2)->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->timestamps();
        });

        Schema::table('invoice', function($table) {
            $table->foreign('task_id')->references('id')->on('task');
            $table->foreign('paid_to')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_invoice');
    }
}
