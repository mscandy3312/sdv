<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Venta;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $faker = Faker::create('es_ES');

        // Crear usuario admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Crear categorías
        $categorias = [
            'Electrónicos',
            'Ropa',
            'Alimentos',
            'Hogar',
            'Juguetes',
            'Deportes',
            'Libros',
            'Belleza'
        ];

        foreach ($categorias as $categoria) {
            Categoria::create([
                'nombre' => $categoria,
                'descripcion' => $faker->sentence()
            ]);
        }

        // Crear productos
        for ($i = 0; $i < 50; $i++) {
            Producto::create([
                'nombre' => $faker->unique()->words(3, true),
                'precio' => $faker->randomFloat(2, 10, 1000),
                'stock' => $faker->numberBetween(0, 100),
                'category_id' => Categoria::inRandomOrder()->first()->id,
                'descripcion' => $faker->paragraph()
            ]);
        }

        // Crear ventas
        for ($i = 0; $i < 30; $i++) {
            $venta = Venta::create([
                'fecha' => $faker->dateTimeBetween('-6 months', 'now'),
                'total' => 0,
                'user_id' => User::inRandomOrder()->first()->id
            ]);

            // Agregar productos a la venta
            $productos = Producto::inRandomOrder()->take(rand(1, 5))->get();
            $total = 0;

            foreach ($productos as $producto) {
                $cantidad = rand(1, 5);
                $venta->productos()->attach($producto->id, [
                    'quantity' => $cantidad,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                $total += $producto->precio * $cantidad;
            }

            $venta->update(['total' => $total]);
        }

        $this->call([
            DemoDataSeeder::class,
            ClientSeeder::class,
            SupplierSeeder::class
        ]);
    }
}
