<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valuations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned(); //selain guest
            $table->string('email_user'); //utk guest
            $table->bigInteger('net_profit');
            $table->integer('cost_equity'); //%
            $table->integer('growth_rate'); //%
            $table->bigInteger('current_assets');
            $table->bigInteger('current_liabilities');
            $table->bigInteger('working_capital');
            $table->bigInteger('depreciation_exist_assets');
            $table->integer('depreciation_rate'); //%
            $table->bigInteger('total_pv_fcfe');
            $table->bigInteger('terminal_value');
            $table->bigInteger('pv_terminal_value');
            $table->bigInteger('business_value');
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
        Schema::dropIfExists('valuations');
    }
}
