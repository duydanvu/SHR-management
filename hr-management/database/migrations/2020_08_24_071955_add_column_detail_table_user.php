<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDetailTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('identity_number')->after('contract_number');// so cmt
            $table->bigInteger('tin')->after('identity_number'); // ma so thue ca nha
            $table->date('idn_date')->after('tin'); // ngay cap CMT
            $table->string('idn_address','255')->after('idn_date'); // noi cap CMT
            $table->bigInteger('ssc_number')->after('idn_address'); // so bao hiem xa hoi
            $table->string('hospital','255')->after('ssc_number'); // noi dang ky kham chua benh
            $table->bigInteger('ban')->after('hospital'); // so tai khoan ngan hang
            $table->string('bank','200')->after('ban'); //ten ngan hang
            $table->string('noi_address','255')->after('bank'); // noi dang ky ho khau
            $table->string('address_now','255')->after('noi_address'); // cho o hien tai
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
