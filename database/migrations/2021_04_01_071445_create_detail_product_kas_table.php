<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailProductKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_product_kas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_headerproduct')->unsigned();
            $table->string('tipe');
            $table->bigInteger('id_typetrans')->unsigned();
            $table->bigInteger('jumlah');
            $table->string('status');
            $table->timestamps();
            $table->foreign('id_headerproduct')->references('id')->on('header_products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_typetrans')->references('id')->on('type_trans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_product_kas');
    }
}
