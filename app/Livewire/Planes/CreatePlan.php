<?php

namespace App\Livewire\Planes;
use App\Models\PlanDePago;

use Livewire\Component;

class CreatePlan extends Component
{
    public $solicitud;

    public $contribuyente_id, $nombre_plan, $cantidad_cuotas, $fecha_inicio;

    public function mount($solicitud)
    {
        $this->solicitud = $solicitud;
        $this->contribuyente_id = $solicitud->contribuyente_id;
        $this->nombre_plan = $solicitud->nombre_plan;
        $this->cantidad_cuotas = $solicitud->cantidad;
        $this->fecha_inicio = $solicitud->fecha_inicio;
    }

    public function render()
    {
        return view('livewire.planes.create-plan');
    }

    public function save()
    {
        $this->validate([
            'contribuyente_id' => 'required|integer',
            'nombre_plan' => 'required|string',
            'cantidad_cuotas' => 'required|numeric',
            'fecha_inicio' => 'required|date',
        ]);

        PlanDePago::create([
            'contribuyente_id' => $this->solicitud->contribuyente_id,
            'solicitud_id' => $this->solicitud->id,
            'nombre_plan' => $this->nombre_plan,
            'cantidad_cuotas' => $this->cantidad_cuotas,
            'fecha_inicio' => $this->fecha_inicio,
        ]);

        session()->flash('message', 'Plan de pago creado exitosamente.');
        return redirect()->route('planes-planes-list'); // Cambiar según la ruta a la lista de planes
    }
}
