<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDValuationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_valuations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('valuation_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('name_year');
            $table->integer('n_year');
            $table->bigInteger('n_sales_forecast');
            $table->bigInteger('n_profit_forecast');
            $table->bigInteger('n_current_assets');
            $table->bigInteger('n_current_liabilities');
            $table->bigInteger('n_working_capital');
            $table->bigInteger('n_change_working_capital');
            $table->bigInteger('n_purchase_new_assets');
            $table->bigInteger('n_depreciation_new_assets');
            $table->bigInteger('n_loans_returned');
            $table->bigInteger('n_new_loan');
            $table->bigInteger('n_seller_discretionary_expend');
            $table->bigInteger('n_cash_flow_fcfe');
            $table->bigInteger('n_pv_fcfe');
            $table->timestamps();
            $table->foreign('valuation_id')->references('id')->on('valuations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_valuations');
    }
}
