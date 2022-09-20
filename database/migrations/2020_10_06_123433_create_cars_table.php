<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('car_immatriculation')->length(50)->unique();
            $table->string('car_model')->length(50);
            $table->string('car_type')->length(50);
            $table->string('car_serial_number')->length(50)->unique();
            $table->string('car_description')->length(100)->nullable();
            $table->enum('car_status', ['EN DEPANNAGE', 'EN FONCTIONNEMENT', 'CHARGER', 'DECHARGER', 'EN COURS ACHEMINEMENT', 'EN COURS DE CHARGEMENT', 'EN COURS DE DECHARGEMENT']);
            $table->string('car_picture')->length(100)->nullable();

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
        Schema::dropIfExists('cars');
    }
}
