<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->string('folio', 100)->primary();
            $table->date('fecha_venta')->nullable();
            $table->integer('num_articulos')->nullable();
            $table->float('subtotal')->nullable();
            $table->float('iva')->nullable();
            $table->float('total')->nullable();
            $table->integer('n')->index('n');
            $table->string('guia', 50)->default('sin guia');
            $table->unsignedInteger('Propina')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
