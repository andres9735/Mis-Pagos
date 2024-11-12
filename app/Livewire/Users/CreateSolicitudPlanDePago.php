<?php

namespace App\Livewire\Users;

use Livewire\Component; 
use App\Models\Contribuyente;
use App\Models\SolicitudPlanDePago;
use App\Models\Deuda; 
use Illuminate\Support\Collection;

class CreateSolicitudPlanDePago extends Component
{
    public $solicitudesPlanDePago, $solicitudPlanDePago, $tipo_plan, $monto, $cuotas, $fecha_inicio, $solicitud_plan_de_pago_id;
    public $isOpen = 0;
    public $solicitudes;
    public $contribuyente_id;
    public Collection $deudas;
    public $montoTotalDeuda = 0;
    public $contribuyentes;
    public $nombre_contribuyente; // Nueva propiedad

    public function obtenerMontoDeuda()
    {
        if ($this->contribuyente_id) {
            $contribuyente = Contribuyente::find($this->contribuyente_id);
            $this->montoTotalDeuda = $contribuyente ? $contribuyente->deudas->sum('monto') : 0;
        }
    }

    public function mount()
    {
        $this->solicitudes = SolicitudPlanDePago::all();
        $this->contribuyentes = Contribuyente::all();
        $this->deudas = collect();
    }

    public function render()
    {
        $this->solicitudesPlanDePago = SolicitudPlanDePago::with('contribuyente')->get();
        return view('livewire.users.create-solicitud-plan-de-pago');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->loadDeudas();
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
        $this->monto = '';
        $this->cuotas = '';
        $this->fecha_inicio = '';
        $this->solicitud_plan_de_pago_id = '';
        $this->montoTotalDeuda = 0;
        $this->deudas = collect();
        $this->nombre_contribuyente = ''; // Reinicia `nombre_contribuyente`
    }

    public function updatedContribuyenteId()
    {
        $this->loadDeudas();

        // Obtener el nombre del contribuyente para guardarlo en la solicitud
        $contribuyente = Contribuyente::find($this->contribuyente_id);
        $this->nombre_contribuyente = $contribuyente ? $contribuyente->nombre : '';
    }

    public function loadDeudas()
    {
        if ($this->contribuyente_id) {
            $contribuyente = Contribuyente::find($this->contribuyente_id);
            $this->deudas = $contribuyente ? $contribuyente->deudas : collect();
            $this->montoTotalDeuda = $this->deudas->sum('monto');
            logger("Monto total de deuda: " . $this->montoTotalDeuda);
        }
    }

    public function store()
    {
        $this->validate([
            'contribuyente_id' => 'required|integer',
            'tipo_plan' => 'required|string',
            'monto' => 'required|numeric|min:0|max:' . ($this->montoTotalDeuda > 0 ? $this->montoTotalDeuda : 0),
            'cuotas' => 'required|integer|min:1|max:10',
            'fecha_inicio' => 'required|date',
        ]);

        if ($this->solicitud_plan_de_pago_id) {
            $solicitudPlanDePago = SolicitudPlanDePago::find($this->solicitud_plan_de_pago_id);
            $solicitudPlanDePago->update([
                'contribuyente_id' => $this->contribuyente_id,
                'tipo_plan' => $this->tipo_plan,
                'nombre_contribuyente' => $this->nombre_contribuyente, 
                'monto' => $this->monto,
                'cuotas' => $this->cuotas,
                'fecha_inicio' => $this->fecha_inicio,
            ]);
            logger("Actualizando solicitud con nombre_contribuyente: " . $this->nombre_contribuyente);
            session()->flash('message', 'Solicitud de plan de pago actualizada correctamente.');
        } else {
            SolicitudPlanDePago::create([
                'contribuyente_id' => $this->contribuyente_id,
                'tipo_plan' => $this->tipo_plan,
                'nombre_contribuyente' => $this->nombre_contribuyente, 
                'monto' => $this->monto,
                'cuotas' => $this->cuotas,
                'fecha_inicio' => $this->fecha_inicio,
            ]);
            logger("Creando solicitud con nombre_contribuyente: " . $this->nombre_contribuyente);
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
        $this->nombre_contribuyente = $solicitudPlanDePago->nombre_contribuyente;
        $this->monto = $solicitudPlanDePago->monto;
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

