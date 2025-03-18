<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Electrónicos', 'description' => 'Productos electrónicos y gadgets', 'status' => true],
            ['name' => 'Ropa', 'description' => 'Todo tipo de prendas de vestir', 'status' => true],
            ['name' => 'Hogar', 'description' => 'Artículos para el hogar', 'status' => true],
            ['name' => 'Deportes', 'description' => 'Equipamiento deportivo', 'status' => true],
            ['name' => 'Libros', 'description' => 'Libros y material de lectura', 'status' => true],
            ['name' => 'Juguetes', 'description' => 'Juguetes y juegos', 'status' => true],
            ['name' => 'Alimentos', 'description' => 'Productos alimenticios', 'status' => true],
            ['name' => 'Bebidas', 'description' => 'Bebidas y refrescos', 'status' => true],
            ['name' => 'Muebles', 'description' => 'Muebles para el hogar y oficina', 'status' => true],
            ['name' => 'Jardín', 'description' => 'Artículos de jardinería', 'status' => true],
            ['name' => 'Mascotas', 'description' => 'Productos para mascotas', 'status' => true],
            ['name' => 'Belleza', 'description' => 'Productos de belleza y cuidado personal', 'status' => true],
            ['name' => 'Herramientas', 'description' => 'Herramientas y equipamiento', 'status' => true],
            ['name' => 'Automotriz', 'description' => 'Accesorios y productos para vehículos', 'status' => true],
            ['name' => 'Música', 'description' => 'Instrumentos y equipos musicales', 'status' => true]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
