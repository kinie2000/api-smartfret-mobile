<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('charge_title')->length(50);
            $table->enum('charge_type', ['Fixe', 'Variable'])->nullable();
            $table->float('charge_amount')->length(20);
            $table->enum('charge_status', ['Regler', 'NonRegler'])->default('NonRegler');
            $table->enum('charge_importance_degree', ['Moyen','Important', 'Très-Important', 'Faible']);
            $table->date('charge_date_start');
            $table->date('charge_date_end')->nullable();
            $table->string('charge_description')->length(100)->nullable();
            $table->integer('agency_id')->unsigned()->nullable();
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
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
        Schema::dropIfExists('charges');
    }
}
