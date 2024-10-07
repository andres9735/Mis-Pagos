<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleContribuyente = Role::create(['name' => 'contribuyente']);
        $roleRecaudacion = Role::create(['name' => 'recaudacion']);
        $roleFiscalizacion = Role::create(['name' => 'fiscalizacion']);

        Permission::create(['name' => 'ver:role']);
        Permission::create(['name' => 'crear:role']);
        Permission::create(['name' => 'editar:role']);
        Permission::create(['name' => 'eliminar:role']);

        Permission::create(['name' => 'ver:permiso']);

        Permission::create(['name' => 'ver:usuario']);
        Permission::create(['name' => 'crear:usuario']);
        Permission::create(['name' => 'editar:usuario']);
        Permission::create(['name' => 'eliminar:usuario']);

        Permission::create(['name' => 'ver:plan']);
        Permission::create(['name' => 'crear:plan']);
        Permission::create(['name' => 'editar:plan']);
        Permission::create(['name' => 'eliminar:plan']);

        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@mail.com';
        $user->password = bcrypt('12345678');
        $user->save();
        $user->assignRole($roleAdmin);

        $user = new User;
        $user->name = 'Contribuyente';
        $user->email = 'contribuyente@mail.com';
        $user->password = bcrypt('12345678');
        $user->save();
        $user->assignRole($roleContribuyente);
    }
}
