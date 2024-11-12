<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contribuyente;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SolicitudPlanDePago extends Model
{
    use HasFactory;

    protected $table = 'solicitud_plan_de_pagos';

    protected $fillable = [
        'contribuyente_id',
        'tipo_plan',
        'nombre_contribuyente',
        'cantidad', 
        'cuotas', 
        'fecha_inicio'
    ];

   /**
     * Get the user that owns the SolicitudPlanDePago
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contribuyente(): BelongsTo
    {
        return $this->belongsTo(Contribuyente::class, 'contribuyente_id', 'id');
    }
}
