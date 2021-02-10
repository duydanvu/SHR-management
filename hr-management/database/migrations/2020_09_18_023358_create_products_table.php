<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('product_code');
            $table->string('contract')->nullable();
            $table->string('type');
            $table->integer('id_supplier');
            $table->string('cooperation');
            $table->double('price_in');
            $table->double('price_out');
            $table->double('hh_default')->nullable();
            $table->integer('hh_percent')->nullable();
            $table->string('status')->nullable();
            $table->string('landing_page')->nullable();
            $table->string('link_supplier')->nullable();
            $table->string('link_transport')->nullable();
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
        Schema::dropIfExists('products');
    }
}
