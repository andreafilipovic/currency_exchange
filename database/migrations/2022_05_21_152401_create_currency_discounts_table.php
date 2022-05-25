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
        Schema::create('currency_discounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('currency_from_id')->unsigned();
            $table->foreign('currency_from_id')->references('id')->on('currencies')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->bigInteger('currency_to_id')->unsigned();
            $table->foreign('currency_to_id')->references('id')->on('currencies')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->float('discount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_discounts');
    }
};
