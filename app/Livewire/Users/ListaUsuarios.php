<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role; 
use Illuminate\Support\Facades\Auth;

class ListaUsuarios extends Component
{
    public $users;
    public $roles;
    public $selectedRole = [];
    
    public function mount()
    {   
        // Obtiene todos los usuarios y sus roles
        $this->users = User::with('roles')->get();

        // Cargar todos los roles
        //$this->roles = Role::all()->pluck('name');
          $this->roles = Role::all();
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        
        // Prevenir que el usuario logueado se elimine a sí mismo
        if ($user->id === Auth::id()) {
            return;
        }

        $user->delete();
        // Refrescar la lista de usuarios
        $this->users = User::all();
    }

    public function assignRole($userId)
    {
        $user = User::findOrFail($userId);

        if (isset($this->selectedRole[$userId])) {
            $role = Role::find($this->selectedRole[$userId]);
            if ($role) {
                // Asigna el rol al usuario, eliminando cualquier rol anterior
                $user->syncRoles([$role->name]);

                // Mensaje de éxito
                session()->flash('message', 'Rol asignado correctamente.');
            }
        }

        // Refrescar la lista de usuarios con sus roles actualizados
        $this->users = User::with('roles')->get();
    }


    public function render()
    {
        return view('livewire.users.lista-usuarios');
    }
}

