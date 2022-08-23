<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRattachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rattachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('etatsup');
            $table->Date('datedebut')->nullable();
            $table->Date('datefin')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('metier_id');
            $table->unsignedBigInteger('ifad_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('metier_id')->references('id')->on('metiers')->onDelete('cascade');
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
        Schema::dropIfExists('rattachers');
    }
}
