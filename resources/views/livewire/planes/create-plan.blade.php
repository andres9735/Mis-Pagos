<div>
    {{ $solicitud }}

    <h1>Formulario para Crear Plan de Pago ESTATICO</h1>
    
    {{ $solicitud }}

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

    <form wire:submit="save">
        @csrf
        
        <div class="form-group">
            <label for="contribuyente">Contribuyente</label>
            <input type="text" wire:model="contribuyente_id" name="contribuyente_id" value="{{ $solicitud->contribuyente->nombre }}" disabled class="form-control">
        </div>

        <div class="form-group">
            <label for="nombre_plan">Nombre del Plan</label>
            <input type="text" wire:model="nombre_plan" id="nombre_plan" name="nombre_plan" value="{{ $solicitud->nombre_plan }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cantidad_cuotas">Cantidad de Cuotas</label>
            <input type="number" wire:model="cantidad_cuotas" id="cantidad_cuotas" name="cantidad_cuotas" value="{{ $solicitud->cantidad_cuotas }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" wire:model="fecha_inicio" id="fecha_inicio" name="fecha_inicio" value="{{ $solicitud->fecha_inicio }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar Plan de Pago</button>
    </form>
</div>
