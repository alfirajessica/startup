<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_products', function (Blueprint $table) {
            $table->id();
            $table->text('name_product');
            $table->bigInteger('id_detailcategory')->unsigned();
            $table->text('url');
            $table->date('rilis');
            $table->mediumText('image')->nullable();
            $table->longText('desc');
            $table->longText('team');
            $table->longText('reason');
            $table->longText('benefit');
            $table->longText('solution');
            $table->string('status');
            $table->timestamps();
            $table->foreign('id_detailcategory')->references('id')->on('detail_category_products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('header_products');
    }
}
