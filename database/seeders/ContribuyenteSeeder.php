<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contribuyente;

class ContribuyenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contribuyente::create([
            'nombre' => 'Juan Perez',
            'dni' => '26456098',
            'email' => 'juanperez@gmail.com',
            'telefono' => '3758-126534',
            'direccion' => 'Las Tunas, 123',
        ]);

        Contribuyente::create([
            'nombre' => 'Roberto Lopez',
            'dni' => '24765001',
            'email' => 'robertolopez@gmail.com',
            'telefono' => '3758-012376',
            'direccion' => 'Salta, 1225',
        ]);
    }
}
