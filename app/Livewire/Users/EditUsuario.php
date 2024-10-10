<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;

class EditUsuario extends Component
{
    //Usuario Editar
    public $user;

    //Variables del Formulario
    public $name;
    public $email;
    public $password;

    public function editar()
    {
        $this->validate([
            'name' => 'required|max:50',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user->id)],
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

        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->password = bcrypt($this->password);
        $this->user->save();

        $this->reset(['name', 'email', 'password']);

        $this->redirectRoute('users-users-index');

    }

    public function mount($id){
        $this->user = User::findOrFail($id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        //$this->password = $this->user->password;
    }

    public function render()
    {
        return view('livewire.users.edit-usuario');
    }
}
