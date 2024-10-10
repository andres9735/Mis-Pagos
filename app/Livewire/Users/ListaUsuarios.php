<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ListaUsuarios extends Component
{
    public $users;

    public function delete($id){
        $user = User::findOrFail($id);
        
        if ($user->id === Auth::id()) {
            return;
        }

        $user->delete();
        $this->users = User::all();
    }

    public function mount(){
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.users.lista-usuarios');
    }
}
