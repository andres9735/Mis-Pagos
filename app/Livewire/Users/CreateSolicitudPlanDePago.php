<?php

namespace App\Livewire\Users;

use App\Models\Contribuyente;
use App\Models\SolicitudPlanDePago;
use App\Models\Deuda; // Importamos el modelo Deuda
use Livewire\Component;

class CreateSolicitudPlanDePago extends Component
{
    public $solicitudesPlanDePago, $solicitudPlanDePago, $contribuyente_id, $tipo_plan, $cantidad, $cuotas, $fecha_inicio, $solicitud_plan_de_pago_id;
    public $isOpen = 0;
    public $solicitudes;
    public $deudas; // Deudas del contribuyente
    public $montoTotalDeuda = 0; // Monto total de deuda del contribuyente
    public $contribuyentes = 0; // Propiedad para almacenar los contribuyentes

    public function mount()
    {
        $this->solicitudes = SolicitudPlanDePago::all();
        $this->contribuyentes = Contribuyente::all(); // Cargar la lista de contribuyentes
    }

    public function render()
    {
        $this->solicitudesPlanDePago = SolicitudPlanDePago::all();
        return view('livewire.users.create-solicitud-plan-de-pago');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->loadDeudas(); // Cargar deudas del contribuyente al abrir el formulario
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
        $this->tipo_plan = '';
        $this->cantidad = '';
        $this->cuotas = '';
        $this->fecha_inicio = '';
        $this->solicitud_plan_de_pago_id = '';
        $this->montoTotalDeuda = 0;
        $this->deudas = [];
    }

    // Cargar las deudas del contribuyente
    public function loadDeudas()
    {
        if ($this->contribuyente_id) {
            $contribuyente = Contribuyente::find($this->contribuyente_id);
            $this->deudas = $contribuyente ? $contribuyente->deudas : [];
            $this->montoTotalDeuda = $this->deudas->sum('monto');
        }
    }

    public function store()
    {
        $this->validate([
            'contribuyente_id' => 'required|integer',
            'tipo_plan' => 'required|string',
            'cantidad' => 'required|numeric|min:0|max:' . $this->montoTotalDeuda, // Validación basada en la deuda total
            'cuotas' => 'required|integer|min:1|max:10',
            'fecha_inicio' => 'required|date',
        ]);

        if ($this->solicitud_plan_de_pago_id) {
            $solicitudPlanDePago = SolicitudPlanDePago::find($this->solicitud_plan_de_pago_id);
            $solicitudPlanDePago->update([
                'contribuyente_id' => $this->contribuyente_id,
                'tipo_plan' => $this->tipo_plan,
                'cantidad' => $this->cantidad,
                'cuotas' => $this->cuotas,
                'fecha_inicio' => $this->fecha_inicio,
            ]);
            session()->flash('message', 'Solicitud de plan de pago actualizada correctamente.');
        } else {
            SolicitudPlanDePago::create([
                'contribuyente_id' => $this->contribuyente_id,
                'tipo_plan' => $this->tipo_plan,
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
        $this->solicitud_plan_de_pago_id = $solicitudPlanDePago->id;
        $this->contribuyente_id = $solicitudPlanDePago->contribuyente_id;
        $this->tipo_plan = $solicitudPlanDePago->tipo_plan;
        $this->cantidad = $solicitudPlanDePago->cantidad;
        $this->cuotas = $solicitudPlanDePago->cuotas;
        $this->fecha_inicio = $solicitudPlanDePago->fecha_inicio;

        $this->loadDeudas();
        $this->openModal();
    }

    public function delete($id)
    {
        SolicitudPlanDePago::find($id)->delete();
        session()->flash('mensaje', 'Solicitud de plan de pago eliminada exitosamente.');
    }
}
