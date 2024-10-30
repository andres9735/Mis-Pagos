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
        Schema::create('planes_de_pago', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitud_id')->constrained('solicitud_plan_de_pagos')->onDelete('cascade');
            $table->foreignId('contribuyente_id')->constrained('contribuyentes');
            $table->string('nombre_plan');
            $table->integer('cantidad_cuotas');
            $table->date('fecha_inicio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planes_de_pago');
    }
};
