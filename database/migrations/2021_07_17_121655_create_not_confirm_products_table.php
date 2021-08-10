<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotConfirmProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('not_confirm_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_headerproduct')->unsigned();
            $table->text('reason');
            $table->timestamps();
            $table->foreign('id_headerproduct')->references('id')->on('header_products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('not_confirm_products');
    }
}
