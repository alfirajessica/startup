<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingInvestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_invests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_headerinvest')->unsigned();
            $table->integer('rating');
            $table->text('review');
            $table->timestamps();
            $table->foreign('id_headerinvest')->references('id')->on('header_invests')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rating_invests');
    }
}
