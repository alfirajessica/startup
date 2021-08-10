<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailInvestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //gak dipakai
        Schema::create('detail_invests', function (Blueprint $table) {
            $table->bigInteger('invest_id');
            $table->bigInteger('id_header_invest')->unsigned();
            $table->bigInteger('jumlah');
            $table->bigInteger('profit');
            $table->string('status');
            $table->timestamps();
            $table->foreign('id_header_invest')->references('id')->on('header_invests')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_invests');
    }
}
