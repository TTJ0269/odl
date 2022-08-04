<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupeActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupe_activites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identifiantgroupe', 10)->nullable();
            $table->string('libellegroupe')->unique();
            $table->integer('etatsup');
            $table->timestamps();

            $table->unsignedBigInteger('metier_id');
            $table->foreign('metier_id')->references('id')->on('metiers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groupe_activites');
    }
}
