<div class="p-6 bg-gray-100 min-h-screen">
    <a href="{{route('users-roles-create')}}" class="inline-block mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
        Crear Rol
    </a>
    
    <table class="w-full bg-white rounded-lg shadow-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Nombre</th>
                <th class="py-3 px-6 text-left">Fecha de Creación</th>
                <th class="py-3 px-6 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-sm font-light">
            @forelse($roles as $role)
            <tr wire:key="{{$role->id}}" class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6">{{ $role->id }}</td>
                <td class="py-3 px-6">{{ $role->name }}</td>
                <td class="py-3 px-6">{{ $role->created_at }}</td>
                <td class="py-3 px-6">
                    <!-- Botón de editar -->
                    <a href="{{route('users-roles-edit', $role->id)}}" 
                       class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition mr-2">
                        Editar
                    </a>
                
                    <!-- Botón de eliminar directamente llamando al método `deleteRole` -->
                    <button wire:click="deleteRole({{ $role->id }})" wire:confirm='Desea borrar el Rol?'
                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                    Eliminar
                    </button>
                </td>                
            </tr>
            @empty
            <tr class="border-b border-gray-200">
                <td colspan="4" class="py-3 px-6 text-center text-gray-500">
                    Sin registros
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
