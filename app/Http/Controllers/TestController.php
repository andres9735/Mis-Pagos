<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contribuyente;

class TestController extends Controller
{
    public function testRelationship()
    {
        // Encuentra un usuario con ID 1 y prueba su relación con Contribuyente
        $user = User::find(1);
        if ($user) {
            $contribuyente = $user->contribuyente;
            echo "Usuario con ID 1 tiene Contribuyente asociado: ";
            var_dump($contribuyente);
        } else {
            echo "Usuario con ID 1 no encontrado.";
        }

        // Encuentra un contribuyente con ID 1 y prueba su relación con User
        $contribuyente = Contribuyente::find(1);
        if ($contribuyente) {
            $user = $contribuyente->user;
            echo "Contribuyente con ID 1 tiene Usuario asociado: ";
            var_dump($user);
        } else {
            echo "Contribuyente con ID 1 no encontrado.";
        }
    }
}
