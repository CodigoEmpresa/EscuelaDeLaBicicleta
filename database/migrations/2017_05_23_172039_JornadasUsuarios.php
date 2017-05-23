<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JornadasUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Jornadas_Usuarios', function(Blueprint $table)
        {
            $table->increments('Id_Registro');
            $table->integer('Id_Jornada')->unsigned();
            $table->integer('Id_Usuario')->unsigned();
            $table->time('Hora_Inicial')->nullable();
            $table->time('Hora_Final')->nullable();
            $table->string('Destreza_Inicial');
            $table->string('Avance_Logrado');
            $table->text('Observaciones');

            $table->foreign('Id_Jornada')->references('Id_Jornada')->on('Jornadas');
            $table->foreign('Id_Usuario')->references('Id_Usuario')->on('Usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Jornadas_Usuarios', function(Blueprint $table)
        {
            $table->dropForeign(['Id_Usuario']);
            $table->dropForeign(['Id_Jornada']);
        });

        Schema::drop('Jornadas_Usuarios');
    }
}
