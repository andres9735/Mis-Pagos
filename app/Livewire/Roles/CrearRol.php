<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class CrearRol extends Component
{
    public $name;
    

    public function save(){
       /* dd([
            'nombre' => $this->name,
        ]); */

        $new_rol = Role::create([
            'name' => $this->name,
        ]);

        $this->reset(['name']);

        $this->redirectRoute('users-roles-index');
    }

    public function render()
    {
        return view('livewire.roles.crear-rol');
    }
}
