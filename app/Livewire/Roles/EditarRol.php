<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class EditarRol extends Component
{
    public $name;

    public $role;

    public function mount($id){
        $this->role = Role::findOrFail($id);
        $this->name = $this->role->name;
    }

    public function save(){
       /* dd([
            'nombre' => $this->name,
        ]); */

        $this->role->name = $this->name;
        $this->role->save();

        $this->reset(['name']);

        $this->redirectRoute('users-roles-index');
    }

    public function render()
    {
        return view('livewire.roles.editar-rol');
    }
}
