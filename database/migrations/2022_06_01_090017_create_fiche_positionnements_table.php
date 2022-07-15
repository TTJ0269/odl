<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichePositionnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiche_positionnements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libellefiche')->unique();
            $table->string('nom_entreprise')->nullable();
            $table->integer('tel_entreprise')->nullable();
            $table->string('email_entreprise')->nullable();
            $table->string('adresse_entreprise')->nullable();
            $table->string('nom_tuteur')->nullable();
            $table->string('prenom_tuteur')->nullable();
            $table->string('tel_tuteur')->nullable();
            $table->string('metier_apprenant')->nullable();
            $table->BigInteger('responsable_suivi_id');
            $table->Date('dateenregistrement')->default(now());
            $table->integer('etat')->default(0);
            $table->integer('etatsup');
            $table->timestamps();

            $table->unsignedBigInteger('association_id');
            $table->foreign('association_id')->references('id')->on('associations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fiche_positionnements');
    }
}
