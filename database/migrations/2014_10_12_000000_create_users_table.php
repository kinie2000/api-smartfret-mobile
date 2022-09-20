<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name')->length(50);
            $table->string('user_surname')->length(50);
            $table->string('user_mail')->length(50)->nullable();
            $table->string('user_phone')->length(20)->unique();
            $table->string('user_adress')->length(50);
            $table->string('user_other_adress')->length(50)->nullable();
            $table->string('user_city')->length(50);
            $table->string('user_country')->length(50);
            $table->string('code_postal')->length(255);
            $table->string('password')->length(255)->unique();
            $table->enum('user_profil', ['ADMINISTRATEUR', 'SUPERADMINISTRATEUR', 'MODERATEUR', 'CONVOYEUR']);
            $table->string('user_status')->nullable()->default("Actif");
            $table->string('user_picture')->length(200)->default("logo.png")->nullable();
            $table->integer('agency_id')->unsigned()->nullable();
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
            $table->integer('subscription_id')->unsigned()->nullable();
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
