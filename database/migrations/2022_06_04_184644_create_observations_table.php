<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('descriptionobservation');
            $table->Date('dateobservation')->default(now());
            $table->integer('etatsup');
            $table->timestamps();

            $table->unsignedBigInteger('fiche_positionnement_id');
            $table->foreign('fiche_positionnement_id')->references('id')->on('fiche_positionnements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observations');
    }
}
