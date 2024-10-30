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
        Schema::table('solicitud_plan_de_pagos', function (Blueprint $table) {
            // Eliminar la clave foránea existente
            $table->dropForeign(['contribuyente_id']);
            // Agregar la clave foránea con eliminación en cascada
            $table->foreign('contribuyente_id')
                  ->references('id')->on('contribuyentes')
                  ->onDelete('cascade')
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solicitud_plan_de_pagos', function (Blueprint $table) {
            // Eliminar la clave foránea con cascada para restaurar el estado original
            $table->dropForeign(['contribuyente_id']);
            // Volver a agregar la clave foránea sin eliminación en cascada (o como estaba antes)
            $table->foreign('contribuyente_id')
                  ->references('id')->on('contribuyentes');
        });
    }
};
