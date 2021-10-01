<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title');
            $table->mediumText('description');
            $table->string('collection');
            $table->string('delivery');
            $table->integer('pickup_floor');
            $table->integer('pickup_lift');
            $table->integer('delivery_floor');
            $table->integer('delivery_lift');
            $table->json('geometry');
            $table->string('distance');
            $table->date('delivery_date');
            $table->string('image')->nullable();
            $table->integer('budget');
            $table->string('delivery_size');
            $table->string('status');
            $table->unsignedBigInteger('awarded_to');
            $table->foreign('awarded_to')->references('id')->on('users');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->json('actual_details')->nullable();
            $table->json('competitors')->nullable();
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
        Schema::dropIfExists('shipments');
    }
}
