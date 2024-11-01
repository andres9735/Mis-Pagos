@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-4">
        <h1 class="text-3xl font-semibold mb-6">Detalle de Auditoría</h1>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Detalles del Registro</h2>
            
            <p><strong>ID de Auditoría:</strong> {{ $auditoria->id }}</p>
            <p><strong>Usuario:</strong> {{ optional($auditoria->user)->name ?? 'N/A' }}</p>
            <p><strong>Evento:</strong> {{ ucfirst($auditoria->event) }}</p>
            <p><strong>Fecha:</strong> {{ $auditoria->created_at->format('d/m/Y H:i') }}</p>

            <h3 class="text-lg font-semibold mt-6 mb-4">Cambios Realizados</h3>
            <ul class="list-disc list-inside">
                @foreach ($auditoria->old_values as $attribute => $old)
                    <li>
                        <strong>{{ $attribute }}:</strong> Antes: {{ $old }} | Después: {{ $auditoria->new_values[$attribute] ?? 'N/A' }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
