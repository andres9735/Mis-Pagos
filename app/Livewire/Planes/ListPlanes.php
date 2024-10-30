<?php

namespace App\Livewire\Planes;

use Livewire\Component;
use App\Models\SolicitudPlanDePago;
use App\Models\PlanDePago;

class ListPlanes extends Component
{

    public $planes; // Almacena la solicitud específica
    public $cuotas = []; // Para manejar la cantidad de cuotas ingresadas

    public function mount()
    {
        // Cargar todas las solicitudes
        $this->planes = PlanDePago::all();

        // Inicializar el array de cuotas para cada solicitud
        /* foreach ($this->solicitudes as $solicitud) {
            $this->cuotas[$solicitud->id] = 1; // Valor inicial por defecto
        } */
    }

    public function generarPlan($solicitudId)
    {
        // Validar la cantidad de cuotas para la solicitud específica
        $this->validate([
            'cuotas.'.$solicitudId => 'required|integer|min:1|max:10',
        ]);

        // Crear el plan de pago
        $solicitud = SolicitudPlanDePago::find($solicitudId);

        // Asegúrate de que $solicitud no sea nulo
        if (!$solicitud) {
            session()->flash('message', 'Solicitud no encontrada.');
            return;
        }

        PlanDePago::create([
            'solicitud_id' => $solicitud->id,
            'contribuyente_id' => $solicitud->contribuyente_id,
            'nombre_plan' => $solicitud->nombre_plan,
            'cantidad_cuotas' => $this->cuotas[$solicitudId],
            'fecha_inicio' => $solicitud->fecha_inicio,
        ]);

        session()->flash('message', 'Plan de pago generado con éxito para la solicitud ID: ' . $solicitudId); 
    }

    public function render()
    {
        return view('livewire.planes.list-planes');
    }
}
