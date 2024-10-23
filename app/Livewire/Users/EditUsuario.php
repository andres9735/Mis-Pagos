<?php

namespace App\Livewire\Users;

use App\Models\User;
use Spatie\Permission\Models\Role; // Importar el modelo Role
use Livewire\Component;
use Illuminate\Validation\Rule;

class EditUsuario extends Component
{
    // Usuario Editar
    public $user;

    // Variables del Formulario
    public $name;
    public $email;
    public $password;
    public $user_role;

    public $roles;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->user_role = $this->user->roles->pluck('name')->first(); // Cargar el rol actual del usuario

        // Cargar todos los roles disponibles
        $this->roles = Role::all()->pluck('name');

        // Verifica si $roles está recibiendo datos
        //dd($this->roles);  // Esto imprimirá los datos y detendrá la ejecución
    }

    public function editar()
    {
        $this->validate([
            'name' => 'required|max:50',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user->id)],
            'password' => 'required|min:8', 
            'user_role' => 'required', // Validar que se seleccione un rol
        ], [
           'name.required' => 'El :attribute es obligatorio',
           'email.required' => 'El :attribute es obligatorio',
           'email.unique' => 'El :attribute ya existe para otro usuario',
           'password.min' => 'El :attribute debe tener por lo menos 8 carateres',
           'user_role.required' => 'El :attribute es obligatorio',
        ], [
            'name' => 'Nombre de usuario',
            'email' => 'Correo electronico',
            'password' => 'Contraseña',
            'user_role' => 'Rol de Usuario',
        ]);

        // Actualizar la información del usuario
        $this->user->name = $this->name;
        $this->user->email = $this->email;
        
        if (!empty($this->password)) {
            $this->user->password = bcrypt($this->password);
        }
        
        $this->user->save();

        // Sincronizar el rol seleccionado
        $this->user->syncRoles([$this->user_role]);

        // Redirigir después de editar
        $this->redirectRoute('users-users-index');
    }

    public function render()
    {
        return view('livewire.users.edit-usuario');
    }
}
