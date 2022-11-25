<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRazaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raza', function (Blueprint $table) {
            $table->unsignedInteger('id_raza')->primary();
            $table->string('raza', 30)->nullable();
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
        Schema::dropIfExists('raza');
    }
}
