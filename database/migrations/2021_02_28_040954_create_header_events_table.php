<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->string('held');
            $table->string('link')->nullable();
            $table->bigInteger('id_province')->nullable();
            $table->text('province_name')->nullable();
            $table->bigInteger('id_city')->nullable();
            $table->text('city_name')->nullable();
            $table->text('address')->nullable();
            $table->date('event_schedule');
            $table->time('event_time')->nullable();
            $table->mediumText('image')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('header_events');
    }
}
