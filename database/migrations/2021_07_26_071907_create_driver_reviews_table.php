<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_reviews', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('driver_id');
            $table->foreign('driver_id')->references('id')->on('users');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('shipment_id');
            $table->foreign('shipment_id')->references('id')->on('shipments');
            $table->unsignedBigInteger('bid_id');
            $table->foreign('bid_id')->references('id')->on('bids');
            $table->mediumText('review');
            $table->integer('rating');
            $table->string('status');
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
        Schema::dropIfExists('driver_reviews');
    }
}
