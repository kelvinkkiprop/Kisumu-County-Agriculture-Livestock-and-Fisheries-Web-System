<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user');
            $table->string('category');
            $table->string('cost');
            $table->integer('quantity');
            $table->string('details');
            $table->string('image');
            $table->integer('status')->default(0);
            $table->integer('delivery')->default(0);
            $table->string('location');
            $table->string('mpesacode');
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
        Schema::dropIfExists('payments');
    }
}
