<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDeuda extends Model
{
    use HasFactory;

    protected $table = 'tipo_deuda'; // Define el nombre exacto de la tabla si no sigue la convención plural

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    // Relación con Deuda
    public function deudas()
    {
        return $this->hasMany(Deuda::class, 'tipo_deuda_id');
    }
}
