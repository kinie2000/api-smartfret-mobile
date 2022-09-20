<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('agency_name')->length(50);
            $table->string('agency_city')->length(100);
            $table->string('agency_country')->length(50);
            $table->string('agency_mailbox')->length(100)->nullable();
            $table->string('agency_adress')->length(50);
            $table->string('agency_type')->length(50)->nullable();
            $table->bigInteger('agency_phone')->length(100)->unique();
            $table->string('agency_picture')->length(100)->nullable();
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
        Schema::dropIfExists('agencies');
    }
}
