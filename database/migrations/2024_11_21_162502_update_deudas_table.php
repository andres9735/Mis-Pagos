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
        Schema::table('deudas', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_deuda_id'); // Agrega el campo tipo_deuda_id
            $table->foreign('tipo_deuda_id')->references('id')->on('tipo_deuda')
                  ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deudas', function (Blueprint $table) {
            $table->dropForeign(['tipo_deuda_id']); // Elimina la relación foránea
        });
    }
};
