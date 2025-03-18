<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SaleSeeder extends Seeder
{
    public function run()
    {
        $customers = Customer::all();
        $products = Product::all();
        $user = User::first(); // Asumiendo que ya tenemos un usuario creado

        if (!$user) {
            throw new \Exception('No hay usuarios en la base de datos. Por favor, ejecute el UserSeeder primero.');
        }

        // Crear 50 ventas en los últimos 30 días
        for ($i = 0; $i < 50; $i++) {
            $customer = $customers->random();
            $saleDate = Carbon::now()->subDays(rand(0, 30));
            
            // Crear la venta
            $sale = Sale::create([
                'code' => 'SALE-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'customer_id' => $customer->id,
                'user_id' => $user->id,
                'total' => 0, // Se actualizará después
                'tax' => 0, // Se actualizará después
                'status' => 'PAID',
                'created_at' => $saleDate,
                'updated_at' => $saleDate
            ]);

            // Agregar entre 1 y 5 productos a la venta
            $numProducts = rand(1, 5);
            $total = 0;
            
            // Seleccionar productos aleatorios sin repetir
            $selectedProducts = $products->random($numProducts);

            foreach ($selectedProducts as $product) {
                $quantity = rand(1, 5);
                $price = $product->price;
                $subtotal = $quantity * $price;
                $total += $subtotal;

                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $subtotal,
                    'created_at' => $saleDate,
                    'updated_at' => $saleDate
                ]);

                // Actualizar el stock del producto
                $product->stock -= $quantity;
                $product->save();
            }

            // Actualizar el total y el impuesto de la venta
            $tax = $total * 0.18; // 18% de impuesto
            $sale->total = $total;
            $sale->tax = $tax;
            $sale->save();
        }
    }
}
