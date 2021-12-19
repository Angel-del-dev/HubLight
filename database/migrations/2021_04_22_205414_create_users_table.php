<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine= "InnoDB";
            $table->increments('id');
            $table->string('name');
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('alies')->default(null);
            $table->string('foto')->default(null);
            $table->string('link')->default(null);
            $table->timestamp('data-naixement')->default(null);
            $table->string('data-registre')->default(null);
            $table->boolean('actiu')->default('0');
            $table->boolean('deshabilitat')->default('0');
            $table->boolean('suspes')->default('0');
            $table->boolean('es_admin')->default('0');
            $table->integer('nivell_gravetat')->default('10');
            $table->integer('grups_disponibles')->default('0');
            $table->string("recomendat");
            $table->unsignedInteger('estadistica');
            $table->unsignedInteger('tipus');
            $table->foreign('estadistica')->references('id_estadistica')->on('estadistiques')->onDelete('cascade');
            $table->foreign('tipus')->references('id')->on('tipus_usuari')->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
