<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Missatge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missatge',function(Blueprint $table) {
            $table->engine= "InnoDB";
            $table->increments('id');
            $table->string('missatge');
            $table->timestamp('data_enviat');
            $table->unsignedInteger('id_xat');
            $table->unsignedInteger('id_usuari');
            $table->unsignedInteger('id_contingut');
            $table->foreign('id_xat')->references('id')->on('xat')->onDelete('cascade');
            $table->foreign('id_usuari')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_contingut')->references('id')->on('contingut')->onDelete('cascade');
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
