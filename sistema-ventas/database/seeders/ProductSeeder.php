<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();
        
        // Lista de productos por categoría
        $productsList = [
            'Electrónicos' => [
                ['name' => 'Smartphone XYZ', 'price' => 599.99, 'stock' => 50],
                ['name' => 'Laptop Pro', 'price' => 1299.99, 'stock' => 30],
                ['name' => 'Tablet Ultra', 'price' => 399.99, 'stock' => 40],
                ['name' => 'Smartwatch Elite', 'price' => 199.99, 'stock' => 45],
                ['name' => 'Auriculares Bluetooth', 'price' => 79.99, 'stock' => 60]
            ],
            'Ropa' => [
                ['name' => 'Camisa Casual', 'price' => 29.99, 'stock' => 100],
                ['name' => 'Jeans Clásicos', 'price' => 49.99, 'stock' => 80],
                ['name' => 'Vestido Elegante', 'price' => 89.99, 'stock' => 40],
                ['name' => 'Chaqueta de Cuero', 'price' => 129.99, 'stock' => 30],
                ['name' => 'Zapatos Deportivos', 'price' => 69.99, 'stock' => 50]
            ],
            'Hogar' => [
                ['name' => 'Juego de Sábanas', 'price' => 39.99, 'stock' => 60],
                ['name' => 'Lámpara de Mesa', 'price' => 45.99, 'stock' => 40],
                ['name' => 'Set de Toallas', 'price' => 34.99, 'stock' => 70],
                ['name' => 'Cortinas Decorativas', 'price' => 59.99, 'stock' => 35],
                ['name' => 'Almohadas Memory Foam', 'price' => 29.99, 'stock' => 80]
            ],
            'Deportes' => [
                ['name' => 'Balón de Fútbol', 'price' => 19.99, 'stock' => 40],
                ['name' => 'Raqueta de Tenis', 'price' => 89.99, 'stock' => 25],
                ['name' => 'Mochila Deportiva', 'price' => 39.99, 'stock' => 45],
                ['name' => 'Pesas Ajustables', 'price' => 149.99, 'stock' => 20],
                ['name' => 'Bicicleta de Montaña', 'price' => 499.99, 'stock' => 15]
            ]
        ];

        $counter = 1;
        foreach ($categories as $category) {
            // Si no hay productos específicos para esta categoría, crear algunos genéricos
            $products = $productsList[$category->name] ?? [
                ['name' => "Producto {$category->name} 1", 'price' => rand(1999, 9999) / 100, 'stock' => rand(10, 100)],
                ['name' => "Producto {$category->name} 2", 'price' => rand(1999, 9999) / 100, 'stock' => rand(10, 100)],
                ['name' => "Producto {$category->name} 3", 'price' => rand(1999, 9999) / 100, 'stock' => rand(10, 100)],
                ['name' => "Producto {$category->name} 4", 'price' => rand(1999, 9999) / 100, 'stock' => rand(10, 100)],
                ['name' => "Producto {$category->name} 5", 'price' => rand(1999, 9999) / 100, 'stock' => rand(10, 100)]
            ];

            foreach ($products as $productData) {
                // Descargar imagen aleatoria de Lorem Picsum
                $imageId = rand(1, 1000);
                $imageUrl = "https://picsum.photos/400/400?random={$imageId}";
                $imageContent = file_get_contents($imageUrl);
                $imageName = "product_{$counter}.jpg";
                File::put(public_path("images/products/{$imageName}"), $imageContent);

                Product::create([
                    'code' => 'PRD-' . str_pad($counter, 4, '0', STR_PAD_LEFT),
                    'name' => $productData['name'],
                    'description' => 'Descripción detallada de ' . $productData['name'],
                    'price' => $productData['price'],
                    'stock' => $productData['stock'],
                    'category_id' => $category->id,
                    'status' => true,
                    'image' => 'images/products/' . $imageName
                ]);

                $counter++;
            }
        }
    }
}
