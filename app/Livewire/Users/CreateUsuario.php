<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class CreateUsuario extends Component
{

    public $name;
    public $email;
    public $password;

    public function guardar(){

        $this->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ], [
           'name.required' => 'El :attribute es obligatorio',
           'email.required' => 'El :attribute es obligatorio',
           'email.unique' => 'El :attribute ya existe para otro usuario',
           'password.required' => 'El :attribute es obligatorio',
           'password.min' => 'El :attribute debe tener por lo menos 8 carateres',
        ], [
            'name' => 'Nombre de usuario',
            'email' => 'Correo electronico',
            'password' => 'Contraseña',
        ]);

        $new_user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $this->reset(['name', 'email', 'password']);

        $this->redirectRoute('users-users-index');
        
    }

    public function render()
    {
        return view('livewire.users.create-usuario');
    }
}
