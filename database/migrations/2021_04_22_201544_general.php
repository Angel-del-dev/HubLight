<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class General extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipus_usuari',function(Blueprint $table) {
            $table->engine= "InnoDB";
            $table->increments('id');
            $table->string('tipus')->primary;
            $table->timestamps();
        });
        Schema::create('estadistiques', function(Blueprint $table) {
            $table->engine= "InnoDB";
            $table->increments('id_estadistica');
            $table->integer('q_comentaris')->default('0');
            $table->integer('q_likes')->default('0');
            $table->integer('q_seguidors')->default('0');
            $table->integer('q_seguits')->default('0');
            $table->integer('q_likes_mensuals')->default('0');
            $table->integer('q_comentaris_mensuals')->default('0');
            $table->timestamps();
        });
        Schema::create('tipus_contingut',function(Blueprint $table) {
            $table->engine= "InnoDB";
            $table->increments('id');
            $table->string('tipus');
            $table->string('icona');
            $table->timestamps();
        });
        Schema::create('estadistiques_contingut',function(Blueprint $table) {
            $table->engine= "InnoDB";
            $table->increments('id_estadistica');
            $table->integer('q_comentaris')->default('0');
            $table->integer('q_likes')->default('0');
            $table->timestamps();
        });
        Schema::create('dret_autor',function(Blueprint $table) {
            $table->engine= "InnoDB";
            $table->increments('id_dret');
            $table->string('tipus');
            $table->string('icona');
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
