<div class="p-6 bg-gray-100 min-h-screen flex items-center justify-center">
    <form wire:submit.prevent="save" class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Nombre del Rol</label>
            <input wire:model="name" type="text" name="name"
                   class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Ingresa el nombre del rol">
        </div>

        <div class="flex justify-end space-x-4">
            <a href="#" 
               class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                Cancelar
            </a>
            <button type="submit" 
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                Guardar
            </button>
        </div>
    </form>
</div>
