<div class="p-4">
    <h2 class="text-2xl font-bold">Lista de Tasas</h2>
    <button wire:click="openModal()" class="bg-blue-500 text-white px-4 py-2 mt-2">Agregar Tasa</button>

    @if (session()->has('message'))
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 3000)" 
            class="bg-green-500 text-white px-4 py-2 my-2"
        >
            {{ session('message') }}
        </div>
    @endif

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Porcentaje</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if($tasas && $tasas->count() > 0)
                @foreach($tasas as $tasa)
                    <tr>
                        <td>{{ $tasa->nombre }}</td>
                        <td>{{ $tasa->descripcion }}</td>
                        <td>{{ $tasa->porcentaje }}%</td>
                        <td>{{ $tasa->estado ? 'Activo' : 'Inactivo' }}</td>
                        <td>
                            <button wire:click="edit({{ $tasa->id }})" class="bg-yellow-500 text-white px-2 py-1">Editar</button>
                            <button wire:click="delete({{ $tasa->id }})" class="bg-red-500 text-white px-2 py-1">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">No se encontraron tasas.</td>
                </tr>
            @endif
        </tbody>        
    </table>

    @if($isOpen)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white p-6 rounded shadow-lg w-1/3">
                    <h2 class="text-2xl font-bold mb-4">{{ $tasaId ? 'Editar Tasa' : 'Crear Tasa' }}</h2>
                    <form>
                        @csrf
                        <label>Nombre:</label>
                        <input type="text" wire:model="nombre" placeholder="Nombre" class="w-full mb-2 p-2 border"/>
                        
                        <label>Descripción:</label>
                        <textarea wire:model="descripcion" placeholder="Descripción" class="w-full mb-2 p-2 border"></textarea>
                        
                        <label>Porcentaje:</label>
                        <input type="number" step="0.01" wire:model="porcentaje" placeholder="Porcentaje" min="0" class="w-full mb-2 p-2 border" />
                        @error('porcentaje') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                        
                        <label>Estado:</label>
                        <select wire:model="estado" class="w-full mb-2 p-2 border">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                        
                        <div class="flex justify-end">
                            <button type="button" wire:click="store" class="bg-blue-500 text-white px-4 py-2 mr-2">Guardar</button>
                            <button type="button" wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
