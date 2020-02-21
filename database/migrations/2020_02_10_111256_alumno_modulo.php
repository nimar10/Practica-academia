<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlumnoModulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_modulo', function (Blueprint $table){
        $table->bigIncrements('id');
        $table->bigInteger('alumno_id')->unsigned(); // clave ajena de tabla alumno
        $table->bigInteger('modulo_id')->unsigned(); // clave ajena de tabla modulo
        $table->decimal('nota', 4,2)->nullable();
        $table->timestamps();
            //Creacion de la clave ajena(foreign key) de alumnos y modulos
            $table->foreign('alumno_id')
            ->references('id')
            ->on('alumnos')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('modulo_id')
            ->references('id')
            ->on('modulos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
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
