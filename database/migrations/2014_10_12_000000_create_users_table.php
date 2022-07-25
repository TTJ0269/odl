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
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nomuser');
            $table->string('prenomuser')->nullable();
            $table->integer('teluser')->unique()->nullable();
            $table->string('imageuser')->nullable();
            $table->integer('etat');
            $table->integer('etatconnection');
            $table->integer('etatsup');
            $table->rememberToken();
            $table->timestamps();

            $table->unsignedBigInteger('profil_id');
            $table->foreign('profil_id')->references('id')->on('profils')->onDelete('cascade');
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
