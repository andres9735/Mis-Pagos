<?php

namespace App\Livewire\Planes;

use Livewire\Component;
use App\Models\SolicitudPlanDePago;
use App\Models\PlanDePago;

class ListPlanes extends Component
{
    public $planes; // Almacena todos los planes de pago
    public $selectedPlan; // Plan de pago seleccionado para editar
    public $isEditModalOpen = false; // Controla la visibilidad del modal
    public $cuotas; // Campo para la edición de cuotas en el modal

    public function mount()
    {
        // Cargar todos los planes de pago al montar el componente
        $this->planes = PlanDePago::all();
    }

    public function openEditModal($id)
    {
        // Buscar el plan de pago para editarlo
        $this->selectedPlan = PlanDePago::find($id);

        if ($this->selectedPlan) {
            // Cargar el valor de las cuotas en la propiedad del modal
            $this->cuotas = $this->selectedPlan->cantidad_cuotas;
            $this->isEditModalOpen = true; // Mostrar el modal
        } else {
            session()->flash('error', 'Plan de pago no encontrado.');
        }
    }

    public function closeEditModal()
    {
        $this->isEditModalOpen = false;
        $this->selectedPlan = null;
        $this->cuotas = null;
    }

/*    public function generarPlan($solicitudId)
    {
        // Validar la cantidad de cuotas para la solicitud específica
        $this->validate([
            'cuotas' => 'required|integer|min:1|max:10',
        ]);

        // Buscar la solicitud de plan de pago
        $solicitud = SolicitudPlanDePago::find($solicitudId);

        if (!$solicitud) {
            session()->flash('error', 'Solicitud no encontrada.');
            return;
        }

        // Verificar si ya existe un plan de pago para esta solicitud
        if (PlanDePago::where('solicitud_id', $solicitudId)->exists()) {
            session()->flash('error', 'Ya existe un plan de pago para esta solicitud.');
            return;
        }

        // Crear un nuevo plan de pago
        PlanDePago::create([
            'solicitud_id' => $solicitud->id,
            'contribuyente_id' => $solicitud->contribuyente_id,
            'nombre_plan' => $solicitud->tipo_plan,
            'cantidad_cuotas' => $this->cuotas,
            'fecha_inicio' => $solicitud->fecha_inicio,
        ]);

        session()->flash('message', 'Plan de pago generado con éxito para la solicitud ID: ' . $solicitudId);

        // Recargar la lista de planes de pago
        $this->planes = PlanDePago::all();
    }

    public function edit($id)
    {
        // Buscar el plan de pago para editarlo
        $this->selectedPlan = PlanDePago::find($id);

        if ($this->selectedPlan) {
            // Cargar los valores en las propiedades del componente
            $this->cuotas = $this->selectedPlan->cantidad_cuotas;
        } else {
            session()->flash('error', 'Plan de pago no encontrado.');
        }
    }
*/        

    public function updatePlan()
    {
        // Validar los datos antes de la actualización
        $this->validate([
            'cuotas' => 'required|integer|min:1|max:10',
        ]);

        if ($this->selectedPlan) {
            // Actualizar el plan de pago seleccionado
            $this->selectedPlan->update([
                'cantidad_cuotas' => $this->cuotas,
            ]);

            session()->flash('message', 'Plan de pago actualizado con éxito.');
            $this->closeEditModal(); // Cerrar el modal
            $this->planes = PlanDePago::all(); // Refrescar la lista de planes
        } else {
            session()->flash('error', 'Error al actualizar el plan de pago.');
        }
    }

    public function delete($id)
    {
        // Eliminar el plan de pago y actualizar la lista
        PlanDePago::findOrFail($id)->delete();
        session()->flash('message', 'Plan de pago eliminado exitosamente.');

        // Recargar la lista de planes de pago después de la eliminación
        $this->planes = PlanDePago::all();
    }

    public function render()
    {
        return view('livewire.planes.list-planes');
    }
}
