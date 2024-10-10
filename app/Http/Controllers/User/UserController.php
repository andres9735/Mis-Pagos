<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function roles_index(){
        return view('users.roles-index');
    }

    /*public function users_index(){
        return view('users.users-index');
    }*/

    public function users_index()
    {
        $users = \App\Models\User::all(); // Cargar todos los usuarios
        return view('users.users-index', compact('users'));
    }

    public function roles_create(){
        return view('users.roles-create');
    }

    public function roles_edit($id){
        return view('users.roles-edit', ['id'=>$id]);
    }

    public function solicitudes_create(){
        return view('users.solicitudes-create');
    }

    public function users_create()
    {   
        // Retorna la vista para crear un nuevo usuario
        return view('users.users-create');
    }

    public function users_edit($id)
    {
        return view('users.users-edit', ['id'=>$id]);
    }

}
