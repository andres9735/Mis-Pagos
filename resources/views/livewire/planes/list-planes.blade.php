<div>
    <h1>Listar Planes de Pago</h1>

    <h2 class="text-xl font-bold mb-3">Solicitudes de Planes de Pago</h2>
    
    @foreach ($planes as $plan)
        <div class="border border-neutral-300 mb-4 p-3">
            <p>Contribuyente: {{ $plan->contribuyente_id }}</p>
            <p>Nombre del Plan: {{ $plan->nombre_plan }}</p>
            <p>Cantidad de Cuotas: {{ $plan->cantidad_cuotas }}</p>
            <p>Fecha de Inicio: {{ $plan->fecha_inicio }}</p>
            <p>cuotas: {{ $plan->cantidad_cuotas }}</p>

            <!-- Campo para ingresar la cantidad de cuotas -->
            {{-- <div>
                <label for="cuotas">Cantidad de Cuotas:</label>
                <input type="number" wire:model="cuotas.{{ $solicitud->id }}" min="1" max="10" step="1" required>
                @error('cuotas.'.$solicitud->id) <span class="text-red-500">{{ $message }}</span> @enderror
            </div> --}}

            <!-- Botón para redirigir a la creación del plan de pago -->
           {{--  <a 
                href="{{ route('planes-plan-create', ['solicitud_id' => $solicitud->id]) }}" 
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4">
                    Crear Plan de Pago
            </a>  --}}           
        </div>
    @endforeach

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>
