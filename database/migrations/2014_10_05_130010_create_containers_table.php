<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('container_number')->length(50)->unique();
            $table->string('container_description')->length(100)->nullable();
            $table->enum('container_status', ['INSCRIT', 'EN COURS DE CHARGEMENT','EN COURS DE DECHARGEMENT', 'DECHARGER','CHARGER', 'EN COURS ACHEMINEMENT', 'ARRIVE ET EN PROCEDURE DE DEDOUANEMENT', 'DECHARGER ET EN COURS DE LIVRAISON'])->default('INSCRIT');
            $table->string('container_picture')->length(100)->nullable();
            $table->date('container_loading_date')->nullable();
            $table->date('container_unloading_date')->nullable();
            $table->bigInteger('container_barcode')->length(10)->unique();
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
        Schema::dropIfExists('containers');
    }
}
