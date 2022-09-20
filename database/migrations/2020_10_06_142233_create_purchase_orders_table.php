<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('purchase_order_number');
            $table->string('purchase_order_title');
            $table->string('purchase_statut');
            $table->integer('purchase_order_number_packet');
            $table->float('divisor_value', 10, 3);
            $table->string('purchase_order_description');
            $table->enum('accept_terme', [0, 1]);
            $table->float('total_amount', 10, 2);
            $table->float('has_paid', 10, 2);
            $table->float('paid', 10, 2);
            $table->float('rest', 10, 2);
            $table->string('signature');
            $table->integer('purchase_order_isDraft')->default(0);
            $table->string('Delivery_address')->nullable();
            $table->enum('barcode_printed', [0, 1])->default(0);
            $table->string('purchase_order_verified')->length(2)->default('V');
            $table->dateTime('purchase_order_date');
            $table->integer('customer_id')->unsigned();
            $table->integer('receiver_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('num_incriment')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->delete(DB::raw('set null'));
            $table->foreign('receiver_id')->references('id')->on('receivers')->delete(DB::raw('set null'));
            $table->foreign('user_id')->references('id')->on('users')->delete(DB::raw('set null'));
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
        Schema::dropIfExists('purchase_orders');
    }
}
