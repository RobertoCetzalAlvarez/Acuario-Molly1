<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('sku');
            $table->string('nombre')->nullable();
            $table->unsignedInteger('precio')->nullable();
            $table->integer('cantidad')->nullable();
            $table->string('foto', 50)->nullable();
            $table->integer('id_comida')->nullable()->index('id_comida');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
