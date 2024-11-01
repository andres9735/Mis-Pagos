<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class PlanDePago extends Model implements Auditable
{
    use AuditableTrait;

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
