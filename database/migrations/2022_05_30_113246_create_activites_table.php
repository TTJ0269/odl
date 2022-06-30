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
            $table->string('identifiantactivite',10)->nullable();
            $table->string('libelleactivite')->unique();
            $table->integer('etatsup');
            $table->timestamps();

            $table->unsignedBigInteger('competence_id');
            $table->unsignedBigInteger('classe_id');
            $table->foreign('competence_id')->references('id')->on('competences')->onDelete('cascade');
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
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
