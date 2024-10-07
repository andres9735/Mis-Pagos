<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class ListaRoles extends Component
{

    public $roles;

    public function mount(){
        $this->roles = Role::all();
    }

    public function deleteRole($roleId)
    {
        // Buscar el rol por su ID
        $role = Role::findOrFail($roleId);
        
        // Eliminar el rol
        $role->delete();

        // Mostrar un mensaje de éxito y redireccionar
        session()->flash('message', 'El rol ha sido eliminado correctamente.');
        //$this->redirectRoute('users-roles-index');

        $this->roles = Role::all();
    
    }


    public function render()
    {
        return view('livewire.roles.lista-roles');
    }
}
