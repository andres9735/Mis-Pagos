<?php

namespace App\Http\Controllers\Planes;

use App\Http\Controllers\Controller;
use App\Models\SolicitudPlanDePago;
use Illuminate\Http\Request;
use App\Models\PlanDePago;

class PlanDePagoController extends Controller
{
    public function plan_list()
    {
        return view('planes.planes-list');
    }

    // Método para mostrar el formulario de creación de plan de pago
    public function plan_create($solicitudId)
    {
        // Busca la solicitud de plan de pago según el ID
        $solicitud = SolicitudPlanDePago::findOrFail($solicitudId);
        
        // Redirige al formulario de crear plan de pago, pasando la solicitud
        return view('planes.planes-create', ['solicitud' => $solicitud]);
    }

    // Método para almacenar el nuevo plan de pago
    /* public function store(Request $request)
    {
        // Valida los datos del formulario
        $validatedData = $request->validate([
            'nombre_plan' => 'required|string|max:255',
            'cantidad_cuotas' => 'required|integer',
            'fecha_inicio' => 'required|date',
            'solicitud_id' => 'required|exists:solicitud_plan_de_pagos,id',
        ]);

        // Verificar si ya existe un plan de pago para esta solicitud
        $existingPlan = PlanDePago::where('solicitud_id', $validatedData['solicitud_id'])->first();

        if ($existingPlan) {
            // Redirige de nuevo con un mensaje de error
            return redirect()->back()->with('error', 'Ya existe un plan de pago para esta solicitud.');
        }

        // Obtén la solicitud para acceder al contribuyente
        $solicitud = SolicitudPlanDePago::findOrFail($validatedData['solicitud_id']);

        // Crear un nuevo plan de pago
        PlanDePago::create([
            'nombre_plan' => $validatedData['nombre_plan'],
            'cantidad_cuotas' => $validatedData['cantidad_cuotas'],
            'fecha_inicio' => $validatedData['fecha_inicio'],
            'solicitud_id' => $validatedData['solicitud_id'],
            'contribuyente_id' => $solicitud->contribuyente_id,
        ]);

        // Redirige a la vista de generación de planes de pago con un mensaje de éxito
        return redirect()->route('planes.plan-generate') // Cambia esto por la ruta correspondiente que muestra las solicitudes
                         ->with('success', 'Plan de Pago creado con éxito');
    } */


}

