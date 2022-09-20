<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandardPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standard_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_standard')->length(255)->nullable();;
            $table->string('name_standard')->length(255);
            $table->integer('price_standard');
            $table->integer('length')->length(11)->nullable();;
            $table->integer('width')->length(11)->nullable();;
            $table->integer('height')->length(11)->nullable();;
            $table->string('type_cars')->length(255)->nullable();;
            $table->integer('days')->length(11)->nullable();;
            $table->string('destination')->length(255)->nullable();;
            $table->string('capacity')->length(1000)->nullable();;
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
        Schema::dropIfExists('standard_packages');
    }
}
