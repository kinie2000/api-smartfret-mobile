<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('minimum_value');
            $table->string('maximum_value');
            $table->float('price', 10, 3);
            $table->string('default_email1')->nullable();
            $table->string('default_email2')->nullable();
            $table->enum('status', ['Actif', 'Inactif'])->default('Inactif');
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
        Schema::dropIfExists('subscriptions');
    }
}
