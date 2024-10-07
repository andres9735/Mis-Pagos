<!-- resources/views/users/create.blade.php -->


<div class="p-6 bg-gray-100 min-h-screen">
    <h2 class="text-lg font-semibold mb-4">Crear Nuevo Usuario</h2>

    <!-- Formulario para crear usuario -->
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nombre:</label>
            <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded p-2 mt-1">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email:</label>
            <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded p-2 mt-1">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Contraseña:</label>
            <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded p-2 mt-1">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
            Guardar
        </button>
    </form>
</div>
