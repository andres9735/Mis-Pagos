<?php

namespace App\Livewire\Auditoria;

use Livewire\Component;
use OwenIt\Auditing\Models\Audit;
use App\Models\PlanDePago;

class ListaAuditorias extends Component
{
    public function render()
    {
        // Obtener las auditorías de planes de pago
        try {
            /* $auditorias = PlanDePago::with('audits')->latest('created_at')->get(); */
            $auditorias = Audit::all();
            /* dd($auditorias); */
        } catch (\Exception $e) {
            // Esto debería mostrar cualquier error que ocurra
            dd($e->getMessage());
        }

        return view('livewire.auditoria.lista-auditorias', compact('auditorias'));
    }

}
