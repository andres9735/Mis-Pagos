<div class="p-6 bg-gray-100 min-h-screen">
    <button wire:click="create()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
        Nueva Solicitud Plan de Pago
    </button>

    @if($isOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded shadow-lg w-full max-w-lg">
                <span class="text-gray-700 text-lg font-semibold cursor-pointer float-right" wire:click="closeModal()">
                    &times;
                </span>
                <form class="space-y-4 mt-6">
                    <div class="form-group">
                        <label for="contribuyente_id" class="block text-sm font-medium text-gray-700">ID Contribuyente</label>
                        <input type="text" wire:model="contribuyente_id" class="mt-1 block w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                    </div>

                    <div class="form-group">
                        <label for="nombre_plan" class="block text-sm font-medium text-gray-700">Nombre Plan</label>
                        <input type="text" wire:model="nombre_plan" class="mt-1 block w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                    </div>

                    <div class="form-group">
                        <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
                        <input type="number" step="1" wire:model="cantidad" class="mt-1 block w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                    </div>

                    <div class="form-group">
                        <label for="cuotas" class="block text-sm font-medium text-gray-700">Cuotas</label>
                        <input type="number" wire:model="cuotas" class="mt-1 block w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                    </div>

                    <div class="form-group">
                        <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha inicio</label>
                        <input type="date" wire:model="fecha_inicio" class="mt-1 block w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                    </div>

                    <button wire:click.prevent="store()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    @endif

    <table class="table-auto w-full mt-8 bg-white rounded shadow-lg">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">ID Contribuyente</th>
                <th class="py-3 px-6 text-left">Nombre Plan</th>
                <th class="py-3 px-6 text-left">Cantidad</th>
                <th class="py-3 px-6 text-left">Cuotas</th>
                <th class="py-3 px-6 text-left">Fecha Inicio</th>
                <th class="py-3 px-6 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-sm font-light">
            @foreach($solicitudesPlanDePago as $request)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $request->contribuyente_id }}</td>
                <td class="py-3 px-6 text-left">{{ $request->nombre_plan }}</td>
                <td class="py-3 px-6 text-left">{{ $request->cantidad }}</td>
                <td class="py-3 px-6 text-left">{{ $request->cuotas }}</td>
                <td class="py-3 px-6 text-left">{{ $request->fecha_inicio }}</td>
                <td class="py-3 px-6 text-center">
                    <a href="{{ route('planes-planes-create', $request->id) }}" wire:navigate class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">crear plan de pago</a>
                    <button wire:click="edit({{ $request->id }})" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Editar</button>
                    <button wire:click="delete({{ $request->id }})" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">Eliminar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

