<?php

use     Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpd102020sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spd_102020s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_product');
            $table->integer('total_product');
            $table->integer('id_user');
            $table->string('email_guest')->nullable();
            $table->string('phone_guest')->nullable();
            $table->integer('bonus_pr');
            $table->integer('total_price');
            $table->integer('total_bonus');
            $table->dateTime('time');
            $table->string('status_transport');
            $table->string('status_payment');
            $table->string('status_kt');
            $table->string('status_admin2');
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
        Schema::dropIfExists('spd_102020s');
    }
}
