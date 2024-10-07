<div class="p-6 bg-gray-100 min-h-screen">
    <!-- Botón para crear un nuevo usuario -->
    <a href="{{ route('users.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
        Crear Usuario
    </a>

    <!-- Tabla de usuarios -->
    <table class="w-full bg-white rounded-lg shadow-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Nombre</th>
                <th class="py-3 px-6 text-left">Fecha de Creación</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-sm font-light">
            @forelse($users as $user)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $user->id }}</td>
                <td class="py-3 px-6 text-left">{{ $user->name }}</td>
                <td class="py-3 px-6 text-left">{{ $user->created_at }}</td>
            </tr>
            @empty
            <tr class="border-b border-gray-200">
                <td colspan="3" class="py-3 px-6 text-center text-gray-500">
                    Sin registros
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
