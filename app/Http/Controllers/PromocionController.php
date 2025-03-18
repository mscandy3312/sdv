<?php

namespace App\Http\Controllers;

class PromocionController extends Controller
{
    public function index()
    {
        $promociones = [
            [
                'nombre' => 'Laptop HP Pavilion',
                'descripcion' => 'Intel Core i5, 8GB RAM, 512GB SSD',
                'precio_original' => 1299.99,
                'precio_descuento' => 974.99,
                'descuento' => 25,
                'imagen' => 'https://via.placeholder.com/600x400'
            ],
            [
                'nombre' => 'iPhone 13 Pro',
                'descripcion' => '128GB, Grafito, 5G',
                'precio_original' => 999.99,
                'precio_descuento' => 849.99,
                'descuento' => 15,
                'imagen' => 'https://via.placeholder.com/600x400'
            ],
            [
                'nombre' => 'Samsung Smart TV 55"',
                'descripcion' => '4K UHD, HDR, Smart Hub',
                'precio_original' => 799.99,
                'precio_descuento' => 559.99,
                'descuento' => 30,
                'imagen' => 'https://via.placeholder.com/600x400'
            ]
        ];

        return view('promociones.index', compact('promociones'));
    }
} 