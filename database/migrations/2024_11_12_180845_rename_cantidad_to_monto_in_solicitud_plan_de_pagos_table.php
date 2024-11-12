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
            $table->renameColumn('cantidad', 'monto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('solicitud_plan_de_pagos', function (Blueprint $table) {
            $table->renameColumn('monto', 'cantidad');
        });
    }
};
