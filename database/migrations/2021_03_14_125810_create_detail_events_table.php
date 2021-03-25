<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_header_events')->unsigned();
            $table->bigInteger('id_participant');
            $table->string('status');
            $table->timestamps();
            $table->foreign('id_header_events')->references('id')->on('header_events')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_events');
    }
}
