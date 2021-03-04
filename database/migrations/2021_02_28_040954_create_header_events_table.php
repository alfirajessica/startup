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
            $table->string('user_id');
            $table->string('name');
            $table->text('desc')->nullable();
            $table->string('held');
            $table->string('link')->nullable();
            $table->bigInteger('province')->nullable();
            $table->bigInteger('city')->nullable();
            $table->text('address')->nullable();
            $table->date('event_schedule');
            $table->time('event_time')->nullable();
            $table->mediumText('image')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('header_events');
    }
}
