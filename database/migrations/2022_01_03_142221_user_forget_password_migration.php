<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserForgetPasswordMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('codevalidations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUser')->nullable();
            $table->integer('idCustomer')->nullable();
            $table->integer('code')->length(5)->unique();
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idCustomer')->references('id')->on('customers');
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
        Schema::dropIfExists('codevalidations');
    }
}
