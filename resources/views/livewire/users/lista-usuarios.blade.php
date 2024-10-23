<div class="p-6 bg-gray-100 min-h-screen">
    
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div id="successMessage" class="mb-4 p-4 bg-green-500 text-white rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Mensaje de error -->
    @if (session()->has('error'))
        <div id="errorMessage" class="mb-4 p-4 bg-red-500 text-white rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Botón para crear un nuevo usuario -->
    <a wire:navigate href="{{route('users-users-create')}}" class="inline-block mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
        Crear Usuario
    </a>

    <!-- Tabla de usuarios -->
    <table class="w-full bg-white rounded-lg shadow-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Nombre</th>
                <th class="py-3 px-6 text-left">Rol</th>
                <th class="py-3 px-6 text-left">Fecha de Creación</th>
                <th class="py-3 px-6 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-sm font-light">
            @forelse($users as $user)
            <tr wire:key="{{$user->id}}" class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $user->id }}</td>
                <td class="py-3 px-6 text-left">{{ $user->name }}</td>
                <td class="py-3 px-6 text-left">
                    <!-- Mostrar el nombre del rol asignado -->
                    @if($user->roles->isNotEmpty())
                        {{ $user->roles->pluck('name')->implode(', ') }}
                    @else
                        Sin rol asignado
                    @endif
                </td>
                <td class="py-3 px-6 text-left">{{ $user->created_at }}</td>
                <td class="py-3 px-6 text-left">
                    <a wire:navigate href="{{route('users-users-edit',$user->id)}}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Editar</a>
                    <button wire:click="delete({{ $user->id }})" wire:confirm="Desea borrar este registro?" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">Eliminar</button>
                </td>
            </tr>
            @empty
            <tr class="border-b border-gray-200">
                <td colspan="5" class="py-3 px-6 text-center text-gray-500">
                    Sin registros
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Bloque de JavaScript para ocultar mensajes después de un tiempo -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ocultar el mensaje de éxito después de 3 segundos
        setTimeout(function() {
            let successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 3000); // 3000 milisegundos = 3 segundos

        // Ocultar el mensaje de error después de 3 segundos
        setTimeout(function() {
            let errorMessage = document.getElementById('errorMessage');
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 3000);
    });
</script>

