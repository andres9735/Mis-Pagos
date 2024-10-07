<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seguridad;
use Inertia\Inertia;
use App\Http\Controllers\User\UserController;
use App\Livewire\SolicitudPlanDePagoComponente;
use App\Models\User;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('permisos', [Seguridad\PermisosController::class, 'index'])->name('permisos.index');
});

Route::get('users/roles', [UserController::class,'roles_index'])->name('users-roles-index');
Route::get('users/user', [UserController::class,'users_index'])->name('users-users-index');
Route::get('users/role/create', [UserController::class,'roles_create'])->name('users-roles-create');
Route::get('users/role/editar/{id}', [UserController::class, 'roles_edit'])->name('users-roles-edit');
Route::get('users/solicitud/create', [UserController::class, 'solicitudes_create'])->name('users-solicitud-create');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');



