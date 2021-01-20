<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_balance_id');
            $table->string('phone_number');
            $table->string('address');
            $table->integer('point');
            $table->integer('deposit');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_balance_id')->references('id')->on('user_balances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
