<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_notif_type')->unsigned();
            $table->bigInteger('user_to_notify1')->unsigned();
            $table->string('name_user_to_notify1');
            $table->integer('read_to_notify1'); 
            $table->bigInteger('user_to_notify2')->unsigned();
            $table->bigInteger('user_fired_event')->unsigned();
            $table->string('name_user_fired_event');
            $table->string('name_product');
            $table->string('data'); 
            $table->integer('read_to_notify2'); 
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
        Schema::dropIfExists('notifications');
    }
}
