<div>
    <h1 class="text-xl font-bold mb-4">Listado de Planes de Pago</h1>

    <!-- Mensajes de éxito o error -->
    @if(session()->has('message'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid gap-4">
        @foreach ($planes as $plan)
            <div class="border border-neutral-300 p-3 rounded shadow-sm">
                <p><span class="font-bold">Contribuyente:</span> {{ $plan->contribuyente_id }}</p>
                <p><span class="font-bold">Nombre del Plan:</span> {{ $plan->nombre_plan }}</p>
                <p><span class="font-bold">Cantidad de Cuotas:</span> {{ $plan->cantidad_cuotas }}</p>
                <p><span class="font-bold">Fecha de Inicio:</span> {{ \Carbon\Carbon::parse($plan->fecha_inicio)->format('d/m/Y') }}</p>

                <!-- Botones de acción -->
                <div class="flex space-x-2 mt-2">
                    <button wire:click="openEditModal({{ $plan->id }})" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Editar</button>
                    <button wire:click="delete({{ $plan->id }})" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Eliminar</button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal de edición de plan de pago -->
    @if($isEditModalOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
                <h2 class="text-lg font-semibold mb-4">Editar Plan de Pago</h2>

                <div class="mb-3">
                    <label for="cantidad_cuotas" class="block font-bold mb-1">Cantidad de Cuotas</label>
                    <input type="number" wire:model="cuotas" id="cantidad_cuotas" min="1" max="10" class="w-full border rounded p-2">
                    @error('cuotas') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2 mt-4">
                    <button wire:click="updatePlan" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Guardar Cambios</button>
                    <button wire:click="closeEditModal" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancelar</button>
                </div>
            </div>
        </div>
    @endif
</div>
