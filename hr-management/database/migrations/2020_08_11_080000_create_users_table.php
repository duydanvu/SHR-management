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
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('gender','7');
            $table->integer('store_id')->unsigned();
            $table->integer('position_id')->unsigned();
            $table->integer('contract_id')->unsigned();
            $table->date('start_time');
            $table->date('end_time');
            $table->timestamp('email_verified_at')->nullable();
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
