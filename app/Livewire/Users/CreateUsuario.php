<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Contribuyente;
use Spatie\Permission\Models\Role;

class CreateUsuario extends Component
{
    public $name, $email, $password, $user_role, $roles;
    public $dni, $telefono, $direccion; 

    public function mount() {
        $this->roles = Role::all()->pluck('name');
    }

    public function guardar() {
        $this->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'user_role' => 'required',
            'dni' => 'required|max:20',
            'telefono' => 'required|max:15',
            'direccion' => 'required|max:255',
        ], [
            'name.required' => 'El :attribute es obligatorio',
            'email.required' => 'El :attribute es obligatorio',
            'email.unique' => 'El :attribute ya existe para otro usuario',
            'password.required' => 'El :attribute es obligatorio',
            'password.min' => 'El :attribute debe tener por lo menos 8 caracteres',
            'user_role.required' => 'El :attribute es obligatorio',
            'dni.required' => 'El :attribute es obligatorio',
            'telefono.required' => 'El :attribute es obligatorio',
            'direccion.required' => 'El :attribute es obligatorio',
        ], [
            'name' => 'Nombre de usuario',
            'email' => 'Correo electrónico',
            'password' => 'Contraseña',
            'user_role' => 'Rol de Usuario',
            'dni' => 'DNI',
            'telefono' => 'Teléfono',
            'direccion' => 'Dirección',
        ]);

        // Crear el nuevo usuario
        $new_user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        // Asignar el rol al nuevo usuario
        $new_user->assignRole($this->user_role);

        // Crear el nuevo contribuyente solo si el rol es 'contribuyente'
        if ($this->user_role === 'contribuyente') {
            Contribuyente::create([
                'nombre' => $this->name,
                'dni' => $this->dni,
                'email' => $this->email,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion,
                'user_id' => $new_user->id, // Suponiendo que hay una relación
            ]);
        }

        // Restablecer las propiedades
        $this->reset(['name', 'email', 'password', 'user_role', 'dni', 'telefono', 'direccion']);

        // Redirigir a la lista de usuarios
        $this->redirectRoute('users-users-index');
    }

    public function render() {
        return view('livewire.users.create-usuario');
    }
}
