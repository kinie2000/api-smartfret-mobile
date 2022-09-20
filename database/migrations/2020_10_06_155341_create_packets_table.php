<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('packet_title')->length(50);
            $table->float('packet_length', 10, 3);
            $table->float('packet_width', 10, 3);
            $table->float('packet_heigth', 10, 3);
            $table->float('packet_price', 10, 2);
            $table->string('number')->length(5);
            $table->enum('packet_status', ['Inscrit', 'CHARGER', 'DECHARGER', 'EN COURS DE CHARGEMENT', 'EN COURS DE DECHARGEMENT', 'EN COURS ACHEMINEMENT', 'ARRIVE ET EN PROCEDURE DE DEDOUANEMENT', 'DECHARGER ET EN COURS DE LIVRAISON', 'LIVRER']);
            $table->string('packet_code_bar')->length(100);
            $table->string('packet_show_title')->default(0);
            $table->dateTime('packet_load_date')->nullable();
            $table->string('packet_picture')->length(100)->nullable();
            $table->enum('packet_state',['En Stock', 'Sortir'])->default('En Stock');
            $table->string('packet_location');
            $table->string('packet_location_agency')->nullable();
            $date->datetime('packet_unload_container_date')->nullable();
            $table->datetime('packet_load_car_date')->nullable();
            $table->datetime('packet_unload_car_date')->nullable();
            $table->integer('purchase_order_id')->unsigned();
            $table->integer('car_id')->unsigned()->nullable();
            $table->integer('container_id')->unsigned()->nullable();
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete(DB::raw('set null'));
            $table->foreign('container_id')->references('id')->on('containers')->onDelete(DB::raw('set null'));
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
        Schema::dropIfExists('packets');
    }
}
