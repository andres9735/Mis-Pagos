<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\Contribuyente;
use App\Models\SolicitudPlanDePago;
use App\Models\Tasa; // Modelo Tasa
use App\Models\Deuda; // Modelo Deuda
use App\Models\TipoDeuda; // Modelo TipoDeuda
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
    public $nombre_contribuyente; // Nombre del contribuyente
    public $tasas = [];
    public $tasa_id;
    public $tipo_deuda_id; // ID del tipo de deuda seleccionado
    public $tipos_deuda = []; // Tipos de deuda disponibles

    public function mount()
    {
        $this->solicitudes = SolicitudPlanDePago::all();
        $this->contribuyentes = Contribuyente::all();
        $this->deudas = collect();
        $this->tasas = Tasa::where('estado', true)->get();
        $this->tipos_deuda = TipoDeuda::where('estado', true)->get(); // Cargar los tipos de deuda activos
    }

    public function render()
    {
        $this->solicitudesPlanDePago = SolicitudPlanDePago::with('contribuyente')->get();
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
        $this->tipo_plan = '';
        $this->monto = '';
        $this->cuotas = '';
        $this->fecha_inicio = '';
        $this->solicitud_plan_de_pago_id = '';
        $this->montoTotalDeuda = 0;
        $this->deudas = collect();
        $this->nombre_contribuyente = ''; 
        $this->tasa_id = '';
        $this->tipo_deuda_id = '';
    }

    public function updatedContribuyenteId()
    {
        $contribuyente = Contribuyente::find($this->contribuyente_id);
        $this->nombre_contribuyente = $contribuyente ? $contribuyente->nombre : '';

        // Limpia el tipo de deuda y recarga las deudas
        $this->tipo_deuda_id = null;
        $this->deudas = collect();
        $this->montoTotalDeuda = 0;
    }


    public function updatedTipoPlan()
    {
        if ($this->tipo_plan) {
            $this->tipo_deuda_id = ($this->tipo_plan === 'inmueble')
                ? TipoDeuda::where('nombre', 'Impuesto Inmueble')->first()->id
                : TipoDeuda::where('nombre', 'Impuesto Comercio')->first()->id;

            // Cargar las deudas después de configurar el tipo_deuda_id
            $this->loadDeudas();
        }
    }



    public function loadDeudas()
    {
        if ($this->contribuyente_id && $this->tipo_deuda_id) {
            // Buscar el contribuyente
            $contribuyente = Contribuyente::find($this->contribuyente_id);
            if ($contribuyente) {
                // Cargar las deudas relacionadas
                $this->deudas = $contribuyente->deudas()
                    ->where('tipo_deuda_id', $this->tipo_deuda_id)
                    ->get();

                // Calcula el monto total de las deudas
                $this->montoTotalDeuda = $this->deudas->sum('monto');
            }
        } else {
            // Si no hay contribuyente o tipo_deuda_id, reinicia las variables
            $this->deudas = collect();
            $this->montoTotalDeuda = 0;
        }
    }


    public function store()
    {
        $this->validate([
            'contribuyente_id' => 'required|integer',
            'tasa_id' => 'required|exists:tasas,id',
            'tipo_deuda_id' => 'required|exists:tipo_deuda,id',
            'tipo_plan' => 'required|string',
            'monto' => 'required|numeric|min:0|max:' . ($this->montoTotalDeuda > 0 ? $this->montoTotalDeuda : 0),
            'cuotas' => 'required|integer|min:1|max:10',
            'fecha_inicio' => 'required|date',
        ]);

        $contribuyente = Contribuyente::find($this->contribuyente_id);
        $this->nombre_contribuyente = $contribuyente ? $contribuyente->nombre : 'N/A'; // Asignar el nombre del contribuyente

        if ($this->solicitud_plan_de_pago_id) {
            $solicitudPlanDePago = SolicitudPlanDePago::find($this->solicitud_plan_de_pago_id);
            $solicitudPlanDePago->update([
                'contribuyente_id' => $this->contribuyente_id,
                'tasa_id' => $this->tasa_id,
                'tipo_deuda_id' => $this->tipo_deuda_id,
                'tipo_plan' => $this->tipo_plan,
                'nombre_contribuyente' => $this->nombre_contribuyente, 
                'monto' => $this->monto,
                'cuotas' => $this->cuotas,
                'fecha_inicio' => $this->fecha_inicio,
            ]);
            session()->flash('message', 'Solicitud de plan de pago actualizada correctamente.');
        } else {
            SolicitudPlanDePago::create([
                'contribuyente_id' => $this->contribuyente_id,
                'tasa_id' => $this->tasa_id,
                'tipo_deuda_id' => $this->tipo_deuda_id,
                'tipo_plan' => $this->tipo_plan,
                'nombre_contribuyente' => $this->nombre_contribuyente, 
                'monto' => $this->monto,
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
        $this->tasa_id = $solicitudPlanDePago->tasa_id;
        $this->tipo_deuda_id = $solicitudPlanDePago->tipo_deuda_id;
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
