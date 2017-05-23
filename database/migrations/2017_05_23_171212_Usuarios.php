<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Usuarios', function(Blueprint $table)
        {
            $table->increments('Id_Usuario');
            $table->integer('Id_Persona')->unsigned();
            $table->integer('Id_Acudiente')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('Id_Acudiente')->references('Id_Acudiente')->on('Acudientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Usuarios');
    }
}
