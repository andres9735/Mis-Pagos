<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class ListaUsuarios extends Component
{
    public $users;

    public function mount(){
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.users.lista-usuarios');
    }
}
