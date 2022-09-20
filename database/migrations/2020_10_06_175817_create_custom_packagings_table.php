<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomPackagingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_packagings', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->integer('custom_id')->unsigned();
            $table->integer('packaging_id')->unsigned();
            $table->foreign('custom_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('packaging_id')->references('id')->on('packagings')->onDelete('cascade');
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
        Schema::dropIfExists('custom_packagings');
    }
}
