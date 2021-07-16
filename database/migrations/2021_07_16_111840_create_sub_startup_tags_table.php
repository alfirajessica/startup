<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubStartupTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_startup_tags', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('startuptag_id')->unsigned();
            $table->string('name_subtag');
            $table->string('status');
            $table->timestamps();
            $table->foreign('startuptag_id')->references('id')->on('h_startup_tags')->onDelete('cascade')->onUpdate('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_startup_tags');
    }
}
