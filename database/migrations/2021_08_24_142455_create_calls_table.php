<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('call_number');
            $table->string('call_description')->nullable();
            $table->string('call_status');
            $table->datetime('call_date');
            $table->integer('purchase_order_id ');
            $table->foreign('purchase_order_id ')->references('id')->on('purchase_orders')->delete(DB::raw('set null'));
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
        Schema::dropIfExists('calls');
    }
}
