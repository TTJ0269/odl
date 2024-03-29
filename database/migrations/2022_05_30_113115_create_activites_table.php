<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identifiantactivite', 10)->nullable();
            $table->string('libelleactivite');
            $table->string('categorie')->nullable();
            $table->integer('etatsup');
            $table->timestamps();

            $table->unsignedBigInteger('groupe_activite_id');
            $table->foreign('groupe_activite_id')->references('id')->on('groupe_activites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activites');
    }
}
