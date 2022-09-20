<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('receiver_name');
            $table->string('receiver_surname')->nullable();
            $table->string('receiver_email')->nullable();
            $table->string('receiver_cni')->nullable();
            $table->string('receiver_phone1')->length(30);
            $table->string('receiver_phone2')->length(30)->nullable();
            $table->string('receiver_city');
            $table->string('receiver_adress')->nullable();
            $table->dateTime('date_create');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('receivers');
    }
}
