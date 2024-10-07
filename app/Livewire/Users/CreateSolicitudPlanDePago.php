<?php

namespace App\Livewire\Users;
use App\Models\SolicitudPlanDePago;

use Livewire\Component;

class CreateSolicitudPlanDePago extends Component
{
        public $solicitudesPlanDePago, $solicitudPlanDePago, $contribuyente_id, $nombre_plan, $cantidad, $cuotas, $fecha_inicio, $solicitud_plan_de_pago_id;
        public $isOpen = 0;

        public $solicitudes;

        public function mount(){
            $this->solicitudes = SolicitudPlanDePago::all();
        }
    
        public function render()
        {
            $this->solicitudesPlanDePago = SolicitudPlanDePago::all();
            return view('livewire.users.create-solicitud-plan-de-pago');
        }
    
        public function create()
        {
            $this->resetInputFields();
            $this->openModal();
        }
    
        public function openModal()
        {
            $this->isOpen = true;
        }
    
        public function closeModal()
        {
            $this->isOpen = false;
        }
    
        private function resetInputFields()
        {   
            $this->contribuyente_id = ''; 
            $this->nombre_plan = '';
            $this->cantidad = '';
            $this->cuotas = '';
            $this->fecha_inicio = '';
            $this->solicitud_plan_de_pago_id = '';
        }
    
        public function store()
        {
            // Validar los datos del formulario
            $this->validate([
                'contribuyente_id' => 'required|integer',
                'nombre_plan' => 'required|string',
                'cantidad' => 'required|numeric',
                'cuotas' => 'required|integer',
                'fecha_inicio' => 'required|date',
            ]);

            // Verificar si es una edición o una creación
            if ($this->solicitud_plan_de_pago_id) {
                // Actualizar el registro existente
                $solicitudPlanDePago = SolicitudPlanDePago::find($this->solicitud_plan_de_pago_id);
                $solicitudPlanDePago->update([
                    'contribuyente_id' => $this->contribuyente_id,
                    'nombre_plan' => $this->nombre_plan,
                    'cantidad' => $this->cantidad,
                    'cuotas' => $this->cuotas,
                    'fecha_inicio' => $this->fecha_inicio,
                ]);
                session()->flash('message', 'Solicitud de plan de pago actualizada correctamente.');
            } else {
                // Crear un nuevo registro
                SolicitudPlanDePago::create([
                    'contribuyente_id' => $this->contribuyente_id,
                    'nombre_plan' => $this->nombre_plan,
                    'cantidad' => $this->cantidad,
                    'cuotas' => $this->cuotas,
                    'fecha_inicio' => $this->fecha_inicio,
                ]);
                session()->flash('message', 'Solicitud de plan de pago creada correctamente.');
            }
    
            $this->closeModal();
            $this->resetInputFields();
        }
    
        public function edit($id)
        {
            $solicitudPlanDePago = SolicitudPlanDePago::findOrFail($id);
            $this->solicitud_plan_de_pago_id = $solicitudPlanDePago->id; // Asignar el ID al campo del componente
            $this->contribuyente_id = $solicitudPlanDePago->contribuyente_id;
            $this->nombre_plan = $solicitudPlanDePago->nombre_plan;
            $this->cantidad = $solicitudPlanDePago->cantidad;
            $this->cuotas = $solicitudPlanDePago->cuotas;
            $this->fecha_inicio = $solicitudPlanDePago->fecha_inicio;
    
            $this->openModal();
        }
    
        public function delete($id)
        {
            SolicitudPlanDePago::find($id)->delete();
            session()->flash('mensaje', 'Solicitud de plan de pago eliminada exitosamente.');
        }
}
