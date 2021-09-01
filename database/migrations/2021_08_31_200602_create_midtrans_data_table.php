<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMidtransDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('midtrans_data', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->bigInteger('invest_id');
            $table->string('payment_type'); //bank transfer
            $table->string('bank'); //nama bank
            $table->bigInteger('va_numbers'); //va number
            $table->bigInteger('gross_amount'); //jumlah tf
            $table->dateTime('transaction_time'); //waktu kadaluarsa
            $table->string('transaction_status'); //setllement
            $table->dateTime('settlement_time'); //settlement_time
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
        Schema::dropIfExists('midtrans_data');
    }
}
