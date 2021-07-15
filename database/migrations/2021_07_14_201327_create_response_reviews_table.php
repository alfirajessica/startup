<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponseReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('response_reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_reviews')->unsigned(); 
            $table->text('response'); 
            $table->string('status'); 
            $table->timestamps();
            $table->foreign('id_reviews')->references('id')->on('reviews')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('response_reviews');
    }
}
