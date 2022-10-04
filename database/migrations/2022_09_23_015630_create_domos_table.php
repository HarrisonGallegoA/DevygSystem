<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombredomo');
            $table->string('descripcion', 200);
            $table->string('tipodomo', 50);
            $table->integer('idCaracteristicas')->unsigned();
            $table->integer('capacidad');
            $table->integer('numerobaños');
            $table->foreign('idCaracteristicas')->references('id')->on('caracteristicas');
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
        Schema::dropIfExists('domos');
    }
};
