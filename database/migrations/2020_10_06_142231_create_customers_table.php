<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name')->length(255);
            $table->string('customer_surname')->length(255);
            $table->char('customer_cni')->length(30)->nullable();
            $table->string('customer_mail')->length(255);
            $table->string('customer_phone')->length(13)->unique();
            $table->string('customer_adress')->length(255);
            $table->string('customer_other_adress')->length(255)->nullable();
            $table->string('customer_city')->length(255)->nullable();
            $table->string('customer_country')->length(255);
            $table->string('Customer_contry_code')->length(255);
            $table->string('customer_password')->length(255);
            $table->integer('reduction_value')->length(10)->default(0);
            $table->integer('reduction_voiture')->length(10)->default(0);
            $table->integer('augmentation')->length(10)->default(0);
            $table->string('customer_picture')->nullable();
            $table->string('customer_post_code')->length(100)->nullable();
            $table->enum('customer_status', ['Actif', 'Inactif']);
            $table->integer('category_id')->unsigned();
            $table->integer('permission_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->string('date_inscription')->length(255);
            $table->string('commentaire')->nullable();
            $table->string('customer_barCode');
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
        Schema::dropIfExists('customers');
    }
}
