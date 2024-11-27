<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SolicitudPlanDePago;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contribuyente extends Model
{
    use HasFactory;

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'user_id',   
        'nombre',    
        'dni',       
        'email',      
        'telefono',   
        'direccion',   
    ];

    public function solicitudes(): HasMany
    {
        return $this->hasMany(SolicitudPlanDePago::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deudas()
    {
        return $this->hasMany(Deuda::class, 'contribuyente_id');
    }



    /*


    public function deudas()
    {
        return $this->hasMany(Deuda::class);
    }


    */
}
