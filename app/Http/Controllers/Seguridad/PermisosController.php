<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermisosController extends Controller
{
    public function index() {
        $permisos = Permission::select('id','name')->get();
        return Inertia::render('Seguridad/Permisos', compact('permisos'));
    }
}
