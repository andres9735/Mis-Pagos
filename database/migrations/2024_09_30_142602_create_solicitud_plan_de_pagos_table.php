<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitud_plan_de_pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contribuyente_id');
            $table->foreign('contribuyente_id')->references('id')->on('contribuyentes');
            $table->string('nombre_plan');
            $table->decimal('cantidad', 10, 2);
            $table->integer('cuotas');
            $table->date('fecha_inicio');
            $table->string('estado')->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_plan_de_pagos');
    }
};
