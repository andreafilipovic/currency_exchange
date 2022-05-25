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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('currency_id')->unsigned();
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->string('email');
            $table->float('currency_exchange_rate');
            $table->bigInteger('currency_surcharge');
            $table->bigInteger('currency_surcharge_amount');
            $table->bigInteger('foreing_currency_amount_purchased');
            $table->bigInteger('current_currency_amount_paid');
            $table->float('currency_discount');
            $table->float('currency_discount_amount');
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
        Schema::dropIfExists('order');
    }
};
