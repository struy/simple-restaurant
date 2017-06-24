<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->integer('dishes_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('dishes_id')->references('id')->on('dishes');
            $table->boolean('confirmed')->default(0);
            $table->unsignedTinyInteger('quantity');
            $table->unsignedTinyInteger('number_table');
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
        Schema::dropIfExists('orders');
    }
}
