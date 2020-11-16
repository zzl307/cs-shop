<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponPublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_publishers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('coupon_publisher_id')->comment('发布者id');
            $table->string('name')->comment('发布者名称');
            $table->string('scenes_used')->nullable()->comment('使用场景');
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
        Schema::dropIfExists('coupon_publishers');
    }
}
