@extends('dashboard')

@section('titulo_vista', 'Crear Plan de Pago')

@section('contenido_vista')
    <h1>Formulario para Crear Plan de Pago</h1>
    
    <!-- Mostrar mensajes de éxito o error -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Datos de la Solicitud en un formato más legible -->
    <div class="p-4 mb-4 border rounded bg-gray-100">
        <h2 class="text-lg font-semibold mb-2">Datos de la Solicitud</h2>
        <table class="w-full text-left">
            <tr>
                <td class="font-bold">ID Solicitud:</td>
                <td>{{ $solicitud->id }}</td>
            </tr>
            <tr>
                <td class="font-bold">Contribuyente:</td>
                <td>{{ $solicitud->nombre_contribuyente }}</td>
            </tr>
            <tr>
                <td class="font-bold">Tipo de Plan:</td>
                <td>{{ ucfirst($solicitud->tipo_plan) }}</td>
            </tr>
            <tr>
                <td class="font-bold">Monto:</td>
                <td>${{ number_format($solicitud->monto, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="font-bold">Cantidad de Cuotas:</td>
                <td>{{ $solicitud->cuotas }}</td>
            </tr>
            <tr>
                <td class="font-bold">Fecha de Inicio:</td>
                <td>{{ \Carbon\Carbon::parse($solicitud->fecha_inicio)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="font-bold">Estado:</td>
                <td>{{ ucfirst($solicitud->estado) }}</td>
            </tr>
        </table>
    </div>

    <!-- Formulario para crear el plan de pago -->
    <form method="POST" action="{{ route('planes-plan-store') }}">
        @csrf

        <!-- Campos del formulario según sea necesario -->
        <div class="form-group">
            <label for="cantidad_cuotas">Cantidad de Cuotas</label>
            <input type="number" id="cantidad_cuotas" name="cantidad_cuotas" value="{{ $solicitud->cuotas }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ $solicitud->fecha_inicio }}" class="form-control" required>
        </div>

        <!-- Guardar el ID de la solicitud para después procesarlo -->
        <input type="hidden" name="solicitud_id" value="{{ $solicitud->id }}">

        <button type="submit" class="btn btn-success">Guardar Plan de Pago</button>
    </form>
@endsection



