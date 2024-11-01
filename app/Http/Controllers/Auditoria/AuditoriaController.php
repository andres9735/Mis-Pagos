<?php

namespace App\Http\Controllers\Auditoria;

use App\Http\Controllers\Controller;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    public function auditoria_index()
    {
        // Retorna la vista estática de auditorías
        return view('auditoria.auditoria-list');
    }

    public function detalle($id)
    {

        // Cargar el registro de auditoría desde la base de datos
        $auditoria = Audit::findOrFail($id);

        // Puedes pasar el id al componente si es necesario
        return view('livewire.auditoria.detalle-auditoria', ['auditoria' => $auditoria]);
    }
}
