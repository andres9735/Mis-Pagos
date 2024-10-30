<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\Planes\PlanDePagoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seguridad;
use Inertia\Inertia;
use App\Http\Controllers\User\UserController;
use App\Livewire\GenerarPlanDePago;
use App\Livewire\SolicitudPlanDePagoComponente;
use App\Models\PlanDePago;
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

// Rutas de usuarios
Route::get('users/roles', [UserController::class,'roles_index'])->name('users-roles-index');
Route::get('users/users', [UserController::class,'users_index'])->name('users-users-index');
Route::get('users/role/create', [UserController::class,'roles_create'])->name('users-roles-create');
Route::get('users/role/editar/{id}', [UserController::class, 'roles_edit'])->name('users-roles-edit');
Route::get('users/create', [UserController::class, 'users_create'])->name('users-users-create');
Route::get('users/user/editar/{id}', [UserController::class, 'users_edit'])->name('users-users-edit');

// rutas a solicitudes
Route::get('solicitudes/create', [UserController::class, 'solicitudes_create'])->name('solicitudes-solicitud-create');

// Rutas de planes
Route::get('planes/planes', [PlanDePagoController::class, 'plan_list'])->name('planes-planes-list');
Route::get('planes/planes/create/{solicitudId}', [PlanDePagoController::class, 'plan_create'])->name('planes-planes-create');

/* Route::get('planes/store', [PlanDePagoController::class, 'store'])->name('planes-plan-store'); */

// Ruta de prueba
Route::get('/test-relationship', [TestController::class, 'testRelationship']);









