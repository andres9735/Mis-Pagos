<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('solicitud_plan_de_pagos', function (Blueprint $table) {
            // Renombrar columna `nombre_plan` a `tipo_plan`
            $table->renameColumn('nombre_plan', 'tipo_plan');
            
            // Agregar la columna `nombre_contribuyente`
            $table->string('nombre_contribuyente')->after('contribuyente_id'); // `after` coloca la columna en una posición específica
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('solicitud_plan_de_pagos', function (Blueprint $table) {
            // Revertir el cambio de nombre de columna
            $table->renameColumn('tipo_plan', 'nombre_plan');
            
            // Eliminar la columna `nombre_contribuyente`
            $table->dropColumn('nombre_contribuyente');
        });
    }
};
