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
            $table->integer('user');
            $table->string('category');
            $table->string('cost');
            $table->integer('quantity');
            $table->string('details');
            $table->string('image');
            $table->string('location');
            $table->integer('status')->default(0);
            $table->integer('delivery')->default(0);
            $table->integer('userconfirmdelivery')->default(0);
            $table->string('mpesacode');
            $table->integer('driver_charges');
            $table->string('receipt_no');
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
