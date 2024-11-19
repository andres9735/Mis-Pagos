<?php

namespace App\Livewire\Planes;

use App\Models\PlanDePago;
use Livewire\Component;

class CreatePlan extends Component
{
    public $solicitud;
    public $contribuyente_id, $tipo_plan, $cantidad_cuotas, $fecha_inicio;
    public $monto_total, $monto_por_cuota;

    public function mount($solicitud)
    {
        $this->solicitud = $solicitud;
        $this->contribuyente_id = $solicitud->contribuyente_id;
        $this->tipo_plan = ucfirst($solicitud->tipo_plan);
        $this->cantidad_cuotas = $solicitud->cuotas;
        $this->fecha_inicio = $solicitud->fecha_inicio;
        $this->monto_total = $solicitud->monto;

        // Calcular el monto inicial por cuota
        $this->calculateMontoPorCuota();
    }

    public function updatedCantidadCuotas()
    {
        // Recalcula el monto por cuota cada vez que se cambia la cantidad de cuotas
        $this->calculateMontoPorCuota();
    }

    private function calculateMontoPorCuota()
    {
        // Calcula el monto por cuota si la cantidad de cuotas es mayor a 0
        $this->monto_por_cuota = ($this->cantidad_cuotas > 0) ? $this->monto_total / $this->cantidad_cuotas : 0;
    }

    public function save()
    {
        $this->validate([
            'contribuyente_id' => 'required|integer',
            'tipo_plan' => 'required|string',
            'cantidad_cuotas' => 'required|integer|min:1|max:10',
            'fecha_inicio' => 'required|date',
        ]);

        PlanDePago::create([
            'solicitud_id' => $this->solicitud->id,
            'contribuyente_id' => $this->contribuyente_id,
            'nombre_plan' => $this->tipo_plan,
            'cantidad_cuotas' => $this->cantidad_cuotas,
            'fecha_inicio' => $this->fecha_inicio,
        ]);

        session()->flash('message', 'Plan de pago creado exitosamente.');
        return redirect()->route('planes-planes-list');
    }

    public function render()
    {
        return view('livewire.planes.create-plan');
    }
}



