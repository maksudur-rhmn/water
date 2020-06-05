<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('user_id');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('country_id');
            $table->string('city_id');
            $table->longText('address');
            $table->longText('notes')->nullable();
            $table->integer('payment_method')->default(1);
            $table->integer('sub_total');
            $table->string('coupon_name')->nullable();
            $table->integer('total');
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
