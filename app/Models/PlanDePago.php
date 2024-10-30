<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanDePago extends Model
{
    use HasFactory;

    protected $table = 'planes_de_pago';

    protected $fillable = [
        'solicitud_id', 'contribuyente_id', 'nombre_plan', 'cantidad_cuotas', 'fecha_inicio'
    ];

    public function solicitud()
    {
        return $this->belongsTo(SolicitudPlanDePago::class, 'solicitud_id');
    }

    public function contribuyente()
    {
        return $this->belongsTo(Contribuyente::class, 'contribuyente_id');
    }
}
