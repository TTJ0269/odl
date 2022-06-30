<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positionnements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('valeurpost');
            $table->integer('etatsup');
            $table->timestamps();

            $table->unsignedBigInteger('activite_id');
            $table->unsignedBigInteger('fiche_positionnement_id');
            $table->foreign('activite_id')->references('id')->on('activites')->onDelete('cascade');
            $table->foreign('fiche_positionnement_id')->references('id')->on('fiche_positionnements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positionnements');
    }
}
