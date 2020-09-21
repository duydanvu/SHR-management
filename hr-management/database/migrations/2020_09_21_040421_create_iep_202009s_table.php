<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIep202009sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iep_202009', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_product');
            $table->integer('id_warehouse');
            $table->integer('import_total');
            $table->integer('export_total');
            $table->date('time');
            $table->integer('total');
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
        Schema::dropIfExists('iep_202009');
    }
}
