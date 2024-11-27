<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contribuyente;
use App\Models\Deuda;
use App\Models\TipoDeuda;
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

        $impuesto_comercio = TipoDeuda::create(['nombre' => 'Impuesto Comercio', 'descripcion' => 'Deuda por comercio', 'estado' => 1]);
        $impuesto_inmueble = TipoDeuda::create(['nombre' => 'Impuesto Inmueble', 'descripcion' => 'Deuda por inmueble', 'estado' => 1]);

        // Asigna deudas a cada contribuyente
        foreach ($contribuyentes as $contribuyente) {
            Deuda::create([
                'contribuyente_id' => $contribuyente->id,
                'tipo_deuda_id' => $impuesto_comercio->id, // Tipo de deuda aleatorio entre los dos específicos
                'monto' => rand(85000, 750000), // Monto de deuda
                'descripcion' => 'Deuda generada de prueba', // Descripción opcional
                'fecha_creacion' => Carbon::now()->subDays(rand(0, 365)), // Fecha de creación en el último año
                'fecha_vencimiento' => Carbon::now()->addDays(rand(30, 180)), // Fecha de vencimiento entre 30 y 180 días desde hoy
            ]);
        }

         // Asigna deudas a cada contribuyente
         foreach ($contribuyentes as $contribuyente) {
            Deuda::create([
                'contribuyente_id' => $contribuyente->id,
                'tipo_deuda_id' => $impuesto_inmueble->id, // Tipo de deuda aleatorio entre los dos específicos
                'monto' => rand(85000, 750000), // Monto de deuda
                'descripcion' => 'Deuda generada de prueba', // Descripción opcional
                'fecha_creacion' => Carbon::now()->subDays(rand(0, 365)), // Fecha de creación en el último año
                'fecha_vencimiento' => Carbon::now()->addDays(rand(30, 180)), // Fecha de vencimiento entre 30 y 180 días desde hoy
            ]);
        }
    }
}

