<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SolicitudPlanDePago;

class Contribuyente extends Model
{
    use HasFactory;

    public function solicitudes(): HasMany
    {
        return $this->hasMany(SolicitudPlanDePago::class);
    }
}
