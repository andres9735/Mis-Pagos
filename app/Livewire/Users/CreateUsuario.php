<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CreateUsuario extends Component
{

    public $name;
    public $email;
    public $password;
    public $user_role;

    public $roles;

    public function mount() {
        $this->roles = Role::all()->pluck('name');
    }

    public function guardar(){

        $this->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'user_role' => 'required',
        ], [
           'name.required' => 'El :attribute es obligatorio',
           'email.required' => 'El :attribute es obligatorio',
           'email.unique' => 'El :attribute ya existe para otro usuario',
           'password.required' => 'El :attribute es obligatorio',
           'password.min' => 'El :attribute debe tener por lo menos 8 carateres',
           'user_role.required' => 'El :attribute es obligatorio',
        ], [
            'name' => 'Nombre de usuario',
            'email' => 'Correo electronico',
            'password' => 'Contraseña',
            'user_role' => 'Rol de Usuario',
        ]);

        $new_user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $new_user->assignRole($this->user_role);

        $this->reset(['name', 'email', 'password', 'user_role']);

        $this->redirectRoute('users-users-index');
        
    }

    public function render()
    {
        return view('livewire.users.create-usuario');
    }
}
