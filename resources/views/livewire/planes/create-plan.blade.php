<div x-data="{ showMessage: true }">
    <h1>Formulario para Crear Plan de Pago</h1>

    @if(session('message'))
        <div 
            x-show="showMessage"
            x-init="setTimeout(() => showMessage = false, 3000)" 
            class="bg-green-500 text-white p-3 mb-4 rounded"
        >
            {{ session('message') }}
        </div>
    @endif

    @if(session('error'))
        <div 
            x-show="showMessage"
            x-init="setTimeout(() => showMessage = false, 3000)" 
            class="bg-red-500 text-white p-3 mb-4 rounded"
        >
            {{ session('error') }}
        </div>
    @endif

    <div class="p-4 mb-4 border rounded bg-gray-100">
        <h2 class="text-lg font-semibold mb-2">Datos de la Solicitud</h2>
        <table class="w-full text-left" style="border-spacing: 5px 0;">
            <tr>
                <td class="font-bold w-1/3">ID Solicitud:</td>
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
                <td class="font-bold">Monto Total:</td>
                <td>${{ number_format($monto_total, 2, ',', '.') }}</td>
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

    <form wire:submit.prevent="save">
        @csrf

        <div class="form-group mb-3">
            <label for="monto_total" class="font-bold">Monto Total</label>
            <input type="text" id="monto_total" wire:model="monto_total" class="w-full border rounded p-2 bg-gray-200" disabled>
        </div>

        <div class="form-group mb-3">
            <label for="cantidad_cuotas" class="font-bold">Cantidad de Cuotas</label>
            <input type="number" id="cantidad_cuotas" wire:model="cantidad_cuotas" wire:change="calculateMontoPorCuota" min="1" max="10" class="w-full border rounded p-2" required>
            @error('cantidad_cuotas') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="monto_por_cuota" class="font-bold">Monto por Cuota</label>
            <input type="text" id="monto_por_cuota" value="${{ number_format($monto_por_cuota, 2, ',', '.') }}" class="w-full border rounded p-2 bg-gray-200" disabled>
        </div>

        <div class="form-group mb-3">
            <label for="fecha_inicio" class="font-bold">Fecha de Inicio</label>
            <input type="date" wire:model="fecha_inicio" id="fecha_inicio" class="w-full border rounded p-2" required>
            @error('fecha_inicio')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Guardar Plan de Pago</button>
    </form>
</div>
