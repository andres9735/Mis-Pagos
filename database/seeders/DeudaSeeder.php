<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contribuyente;
use App\Models\Deuda;
use Carbon\Carbon;

class DeudaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtiene todos los contribuyentes existentes
        $contribuyentes = Contribuyente::all();

        // Tipos de deuda específicos
        $tiposDeuda = ['Impuesto Inmueble', 'Impuesto Comercio'];

        // Asigna deudas a cada contribuyente
        foreach ($contribuyentes as $contribuyente) {
            // Genera un número aleatorio de deudas para cada contribuyente
            for ($i = 0; $i < rand(1, 3); $i++) {
                Deuda::create([
                    'contribuyente_id' => $contribuyente->id,
                    'tipo_deuda' => $tiposDeuda[array_rand($tiposDeuda)], // Tipo de deuda aleatorio entre los dos específicos
                    'monto' => rand(85000, 750000), // Monto de deuda
                    'descripcion' => 'Deuda generada de prueba', // Descripción opcional
                    'fecha_creacion' => Carbon::now()->subDays(rand(0, 365)), // Fecha de creación en el último año
                    'fecha_vencimiento' => Carbon::now()->addDays(rand(30, 180)), // Fecha de vencimiento entre 30 y 180 días desde hoy
                ]);
            }
        }
    }
}

