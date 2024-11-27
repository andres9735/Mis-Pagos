<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deuda extends Model
{
    use HasFactory;

    protected $fillable = [
        'contribuyente_id',
        'tipo_deuda_id',
        'monto',
        'descripcion',
        'fecha_creacion',
        'fecha_vencimiento',
    ];

    // Relación con TipoDeuda
    public function tipoDeuda()
    {
        return $this->belongsTo(TipoDeuda::class, 'tipo_deuda_id');
    }

     // Relación con Contribuyente
     public function contribuyente()
     {
        return $this->belongsTo(Contribuyente::class, 'contribuyente_id', 'id');
     }

     /*


     public function contribuyente()
     {
         return $this->belongsTo(Contribuyente::class);
     }


     */
}

