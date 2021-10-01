<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('image')->nullable();
            $table->text('about')->nullable();
            $table->string('type');
            $table->string('phone');
            $table->string('address');
            $table->string('country');
            $table->string('state');
            $table->string('zip');
            $table->string('status')->default('UNAPPROVED');
            $table->string('password');
            $table->json('documents')->nullable();
            $table->integer('membership')->nullable();
            $table->date('membership_date')->nullable();
            $table->string('membership_status')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
