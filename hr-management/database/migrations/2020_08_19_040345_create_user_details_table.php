<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->references('id')->on('users');
            $table->bigInteger('identity_number');// so cmt
            $table->bigInteger('tin'); // ma so thue ca nha
            $table->date('idn_date'); // ngay cap CMT
            $table->string('idn_address','255'); // noi cap CMT
            $table->bigInteger('ssc_number'); // so bao hiem xa hoi
            $table->string('hospital','255'); // noi dang ky kham chua benh
            $table->bigInteger('ban'); // so tai khoan ngan hang
            $table->string('bank','200'); //ten ngan hang
            $table->string('noi_address','255'); // noi dang ky ho khau
            $table->string('address_now','255'); // cho o hien tai
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
        Schema::dropIfExists('user_details');
    }
}
