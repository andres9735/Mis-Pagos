<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deuda extends Model
{
    use HasFactory;

    protected $fillable = ['contribuyente_id', 'monto', 'descripcion', 'fecha_vencimiento'];

    public function contribuyente()
    {
        return $this->belongsTo(Contribuyente::class);
    }
}

