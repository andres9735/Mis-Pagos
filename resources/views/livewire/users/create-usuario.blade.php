<!-- resources/views/users/create.blade.php -->

<div class="p-6 bg-gray-100 min-h-screen">
    <h2 class="text-lg font-semibold mb-4">Crear Nuevo Usuario</h2>

    <!-- Formulario para crear usuario -->
    <form wire:submit="guardar">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nombre:</label>
            <input type="text" wire:model="name" name="name" id="name" class="w-full border border-gray-300 rounded p-2 mt-1">
            @error('name')
              <span class="text-red-400">{{ $message }}</span>  
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email:</label>
            <input type="email" wire:model="email" name="email" id="email" class="w-full border border-gray-300 rounded p-2 mt-1">
            @error('email')
              <span class="text-red-400">{{ $message }}</span>  
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Contraseña:</label>
            <input type="password" wire:model="password" name="password" id="password" class="w-full border border-gray-300 rounded p-2 mt-1">
            @error('password')
              <span class="text-red-400">{{ $message }}</span>  
            @enderror
        </div>

        <div class="mb-4">
          <label for="password" class="block text-gray-700">Contraseña:</label>
          <select wire:model="user_role" name="user_role" id="user_role">
            <option value="" selected>Selecione un rol</option>
            @foreach($roles as $role)
            <option value="{{$role}}" >{{$role}}</option>
            @endforeach
          </select>
          @error('user_role')
            <span class="text-red-400">{{ $message }}</span>  
          @enderror
      </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
            Guardar
        </button>
    </form>
</div>
