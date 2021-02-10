<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateW2WSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w2w', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_warehouse_from');
            $table->integer('id_warehouse_to');
            $table->date('time');
            $table->string('status');
            $table->integer('id_action');
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
        Schema::dropIfExists('w2ws');
    }
}
