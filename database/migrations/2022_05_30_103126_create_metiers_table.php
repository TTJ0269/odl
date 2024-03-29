<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libellemetier');
            $table->string('niveaumetier')->nullable();
            $table->integer('etatsup');
            $table->timestamps();

            $table->unsignedBigInteger('ifad_id');
            $table->foreign('ifad_id')->references('id')->on('ifads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metiers');
    }
}
