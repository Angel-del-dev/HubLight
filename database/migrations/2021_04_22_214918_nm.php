<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Nm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguidors',function(Blueprint $table) {
            $table->engine= "InnoDB";
            $table->unsignedInteger('id_usuari');
            $table->unsignedInteger('id_seguit');
            $table->foreign('id_usuari')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_seguit')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('avis_usuari',function(Blueprint $table) {
            $table->engine= "InnoDB";
            $table->unsignedInteger('id_usuari');
            $table->unsignedInteger('id_avis');
            $table->foreign('id_usuari')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_avis')->references('id')->on('avis')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('grups_usuaris',function(Blueprint $table) {
            $table->engine= "InnoDB";
            $table->unsignedInteger('id_usuari');
            $table->unsignedInteger('id_grup');
            $table->boolean('es_admin');
            $table->foreign('id_usuari')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_grup')->references('id')->on('grup')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('xat_usuaris',function(Blueprint $table) {
            $table->engine= "InnoDB";
            $table->unsignedInteger('id_xat');
            $table->unsignedInteger('id_usuari');
            $table->boolean('es_admin');
            $table->foreign('id_usuari')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_xat')->references('id')->on('xat')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('xat_grup',function(Blueprint $table) {
            $table->engine= "InnoDB";
            $table->unsignedInteger('id_xat');
            $table->unsignedInteger('id_grup');
            $table->boolean('es_admin');
            $table->foreign('id_xat')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_grup')->references('id')->on('grup')->onDelete('cascade');
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
