<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponCodePublisherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_code_publisher', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code_id')->unsigned()->index();
            $table->foreign('code_id')->references('id')->on('coupon_codes')->onDelete('cascade');
            $table->integer('publisher_id')->unsigned()->index();
            $table->foreign('publisher_id')->references('id')->on('coupon_publishers')->onDelete('cascade');
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
        Schema::dropIfExists('coupon_code_publisher');
    }
}
