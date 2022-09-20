<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payement_method');
            $table->float('payement_amount', 10, 2);
            $table->string('payment_comments')->nullable();
            $table->integer('paid_after_invoicing');
            $table->integer('payment_verified')->default(0);
            $table->integer('purchase_order_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('checkout_id')->unsigned();
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete(DB::raw('set null'));
            $table->foreign('checkout_id')->references('id')->on('checkouts')->onDelete(DB::raw('set null'));
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
        Schema::dropIfExists('payments');
    }
}
