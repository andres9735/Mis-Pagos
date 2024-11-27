<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeudasTable extends Migration
{
    public function up()
    {
        Schema::create('deudas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contribuyente_id')->constrained()->onDelete('cascade');
            $table->decimal('monto', 10, 2); // Monto de la deuda
            $table->string('descripcion')->nullable(); // Descripción opcional de la deuda
            $table->date('fecha_creacion');
            $table->date('fecha_vencimiento');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deudas');
    }
}