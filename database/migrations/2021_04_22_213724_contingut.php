<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contingut extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contingut',function(Blueprint $table) {
            $table->engine= "InnoDB";
            $table->increments('id');
            $table->string('titol');
            $table->string('portada');
            $table->string('link_copyright');
            $table->string('url');
            $table->string("descripcio");
            $table->boolean("majoria_edat")->default("0");
            $table->boolean("reportat")->default("0");
            $table->unsignedInteger("estadistica");
            $table->unsignedInteger("propietari");
            $table->unsignedInteger('tipus_contingut');
            $table->unsignedInteger('drets_autor');
            $table->foreign('estadistica')->references('id_estadistica')->on('estadistiques_contingut')->onDelete('cascade');
            $table->foreign('tipus_contingut')->references('id')->on('tipus_contingut')->onDelete('cascade');
            $table->foreign('drets_autor')->references('id_dret')->on('dret_autor')->onDelete('cascade');
            $table->foreign('propietari')->references('id')->on('users')->onDelete('cascade');
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
        //
    }
}
