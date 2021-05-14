<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderInvestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_invests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('project_id')->unsigned();
            $table->bigInteger('invest_id')->unsigned();
            $table->bigInteger('jumlah_invest');
            $table->bigInteger('jumlah_final'); //setelah terkena potongan 1%
            $table->string('status_transaction'); //status berdasarkan midtrans
            $table->string('status_invest');  
            $table->date('invest_expire');
            //masih aktif invest atau tidak -- 0(Menunggu konfirmasi admin), (1-aktif invst/dikonfirmasi), (2-tdk aktif)
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
        Schema::dropIfExists('header_invests');
    }
}
