<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMascotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->unsignedInteger('id_mascota')->nullable();
            $table->string('nombre', 90)->nullable();
            $table->string('edad', 90)->nullable();
            $table->string('genero', 1)->nullable();
            $table->unsignedInteger('peso')->nullable();
            $table->unsignedInteger('id_propietario')->nullable();
            $table->unsignedInteger('id_especie')->nullable()->index('id_especie');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mascotas');
    }
}
