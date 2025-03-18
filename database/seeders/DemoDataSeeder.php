<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venta;
use Carbon\Carbon;
use App\Models\Cliente;
use App\Models\Proveedor;

class DemoDataSeeder extends Seeder
{
    public function run()
    {
        // Limpiar ventas existentes
        Venta::truncate();

        // Crear ventas para los últimos 6 meses
        $meses = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        
        foreach ($meses as $mes) {
            // Crear entre 20 y 30 ventas por mes
            $numVentas = rand(20, 30);
            
            for ($i = 0; $i < $numVentas; $i++) {
                Venta::create([
                    'total' => rand(500, 5000),
                    'created_at' => Carbon::parse("2024-$mes-" . rand(1, 28)),
                    'updated_at' => Carbon::now()
                ]);
            }
        }

        // Crear ventas para hoy y este mes
        // Ventas de hoy (entre 5 y 10)
        for ($i = 0; $i < rand(5, 10); $i++) {
            Venta::create([
                'total' => rand(500, 5000),
                'created_at' => Carbon::today()->addHours(rand(9, 17)),
                'updated_at' => Carbon::now()
            ]);
        }

        // Ventas adicionales para este mes (entre 30 y 50)
        for ($i = 0; $i < rand(30, 50); $i++) {
            Venta::create([
                'total' => rand(500, 5000),
                'created_at' => Carbon::now()->startOfMonth()->addDays(rand(1, 28)),
                'updated_at' => Carbon::now()
            ]);
        }

        // Crear clientes de prueba
        Cliente::create([
            'nombre' => 'Juan Pérez',
            'documento' => '12345678',
            'email' => 'juan@example.com',
            'telefono' => '987654321',
            'direccion' => 'Av. Principal 123'
        ]);

        Cliente::create([
            'nombre' => 'María García',
            'documento' => '87654321',
            'email' => 'maria@example.com',
            'telefono' => '123456789',
            'direccion' => 'Jr. Secundario 456'
        ]);

        // Crear proveedores de prueba
        Proveedor::create([
            'nombre' => 'Distribuidora XYZ',
            'ruc' => '20123456789',
            'email' => 'ventas@xyz.com',
            'telefono' => '555-1234',
            'direccion' => 'Zona Industrial A-5',
            'descripcion' => 'Proveedor principal de electrónicos'
        ]);

        Proveedor::create([
            'nombre' => 'Importaciones ABC',
            'ruc' => '20987654321',
            'email' => 'contacto@abc.com',
            'telefono' => '555-5678',
            'direccion' => 'Av. Comercial 789',
            'descripcion' => 'Importador mayorista'
        ]);
    }
} 