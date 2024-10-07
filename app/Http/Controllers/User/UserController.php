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

    public function create()
    {   
        // Retorna la vista para crear un nuevo usuario
        return view('livewire.users.create'); 
    }

    /*
    public function store(Request $request)
    {
        // Depurar los datos que llegan del formulario
        dd($request->all());

        // Validar los datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Crear el nuevo usuario
        \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), 
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('users-users.index')->with('message', 'Usuario creado exitosamente.');
    }
    */

}
