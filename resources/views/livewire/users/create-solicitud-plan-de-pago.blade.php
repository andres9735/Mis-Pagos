<div class="p-6 bg-gray-100 min-h-screen">
    <!-- Mostrar mensajes de éxito o error -->
    @if(session()->has('message'))
        <div x-data="{ open: true }" x-show="open" @click.outside="open=false" class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('message') }}
            <button @click="open = ! open" >Cerrar</button>
        </div>
    @elseif(session()->has('mensaje'))
        <div class="bg-red-500 text-white p-2 rounded mb-4">
            {{ session('mensaje') }}
        </div>
    @endif
    
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
                    <!-- Campo para ID Contribuyente -->
                    <div class="form-group">
                        <label for="contribuyente_id" class="block text-sm font-medium text-gray-700">Contribuyente</label>
                        <select wire:model="contribuyente_id" class="mt-1 block w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                            <option value="">Seleccione un contribuyente</option>
                            @foreach($contribuyentes as $contribuyente)
                                <option value="{{ $contribuyente->id }}">{{ $contribuyente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nombre del Contribuyente -->
                    <div class="form-group">
                        <label for="nombre_contribuyente" class="block text-sm font-medium text-gray-700">Nombre Contribuyente</label>
                        <input type="text" wire:model="nombre_contribuyente" readonly class="mt-1 block w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                    </div>

                    <!-- Campo para Tasa -->
                    <div class="form-group">
                        <label for="tasa_id" class="block text-sm font-medium text-gray-700">Tasa</label>
                        <select wire:model="tasa_id" class="mt-1 block w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                            <option value="">Seleccione una tasa</option>
                            @foreach($tasas as $tasa)
                                <option value="{{ $tasa->id }}">{{ $tasa->nombre }} ({{ $tasa->porcentaje }}%)</option>
                            @endforeach
                        </select>
                        @error('tasa_id') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Campo para Tipo de Plan -->
                    <div class="form-group">
                        <label for="tipo_plan" class="block text-sm font-medium text-gray-700">Tipo de Plan</label>
                        <select wire:model="tipo_plan" class="mt-1 block w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                            <option value="">Seleccione un tipo de plan</option>
                            <option value="inmueble">Plan de Pago Inmueble</option>
                            <option value="comercio">Plan de Pago Comercio</option>
                        </select>
                    </div>
                    

                    <!-- Monto total de deuda -->
                    <div class="form-group">
                        <label for="deuda_total" class="block text-sm font-medium text-gray-700">Monto total de deuda:</label>
                        <span class="block mt-1 text-gray-900">{{ number_format($montoTotalDeuda, 2) }}</span>
                    </div>                    

                    <!-- Monto a incluir en el plan de pago -->
                    <div class="form-group">
                        <label for="monto" class="block text-sm font-medium text-gray-700">Monto a incluir en el plan de pago:</label>
                        <input type="number" wire:model="monto" min="0" max="{{ $montoTotalDeuda }}" class="mt-1 block w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                    </div>

                    <!-- Campo para Cuotas -->
                    <div class="form-group">
                        <label for="cuotas" class="block text-sm font-medium text-gray-700">Cuotas</label>
                        <input type="number" wire:model="cuotas" min="1" max="10" class="mt-1 block w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring focus:border-blue-300">

                         <!-- Mensajes de error para el campo cuotas -->
                        @if($errors->has('cuotas'))
                            <div class="mt-2 text-red-500 text-sm">
                                {{ $errors->first('cuotas') }}
                            </div>
                        @endif
                    </div>

                    <!-- Campo para Fecha de Inicio -->
                    <div class="form-group">
                        <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha inicio</label>
                        <input type="date" wire:model="fecha_inicio" class="mt-1 block w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                    </div>

                    <!-- Botón Guardar -->
                    <button wire:click.prevent="store()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    @endif

    <!-- Tabla de Solicitudes -->
    <table class="table-auto w-full mt-8 bg-white rounded shadow-lg">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">ID Contribuyente</th>
                <th class="py-3 px-6 text-left">Nombre Contribuyente</th>
                <th class="py-3 px-6 text-left">Tipo Plan</th>
                <th class="py-3 px-6 text-left">Monto</th>
                <th class="py-3 px-6 text-left">Cuotas</th>
                <th class="py-3 px-6 text-left">Fecha Inicio</th>
                <th class="py-3 px-6 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-sm font-light">
            @foreach($solicitudesPlanDePago as $request)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $request->contribuyente_id }}</td>
                <td class="py-3 px-6 text-left">{{ $request->nombre_contribuyente }}</td>
                <td class="py-3 px-6 text-left">{{ $request->tipo_plan }}</td>
                <td class="py-3 px-6 text-left">{{ $request->monto }}</td>
                <td class="py-3 px-6 text-left">{{ $request->cuotas }}</td>
                <td class="py-3 px-6 text-left">{{ \Carbon\Carbon::parse($request->fecha_inicio)->format('d/m/Y') }}</td>
                <td class="py-3 px-6 text-center">
                    <div class="flex justify-center space-x-2">
                        <a href="{{ route('planes-planes-create', $request->id) }}" wire:navigate class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 transition">crear plan de pago</a>
                        <button wire:click="edit({{ $request->id }})" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Editar</button>
                        <button wire:click="delete({{ $request->id }})" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">Eliminar</button>
                    </div>
                </td>                               
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
