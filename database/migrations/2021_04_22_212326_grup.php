<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Grup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grup',function(Blueprint $table) {
            $table->engine= "InnoDB";
            $table->increments('id');
            $table->string('nom');
            $table->string('descripcio');
            $table->boolean('suspes');
            $table->unsignedInteger('xat');
            $table->unsignedInteger('estadistica');
            $table->unsignedInteger('tipus_usuari');
            $table->foreign('estadistica')->references('id_estadistica')->on('estadistiques')->onDelete('cascade');
            $table->foreign('tipus_usuari')->references('id')->on('tipus_usuari')->onDelete('cascade');
            $table->foreign('xat')->references('id')->on('xat')->onDelete('cascade');
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
