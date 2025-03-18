<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::with(['customer', 'user'])->get();
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::where('status', true)->get();
        $products = Product::where('status', true)->get();
        return view('sales.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            \DB::beginTransaction();

            // Crear la venta
            $sale = Sale::create([
                'code' => 'VTA-' . time(),
                'customer_id' => $request->customer_id,
                'user_id' => auth()->id(),
                'total' => 0,
                'tax' => 0,
                'status' => 'PENDING'
            ]);

            $total = 0;

            // Crear los detalles de la venta
            foreach ($request->products as $product) {
                $productModel = Product::find($product['id']);
                
                if ($productModel->stock < $product['quantity']) {
                    throw new \Exception("Stock insuficiente para el producto {$productModel->name}");
                }

                $subtotal = $productModel->price * $product['quantity'];
                
                $sale->saleDetails()->create([
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity'],
                    'price' => $productModel->price,
                    'subtotal' => $subtotal
                ]);

                // Actualizar stock
                $productModel->update([
                    'stock' => $productModel->stock - $product['quantity']
                ]);

                $total += $subtotal;
            }

            // Actualizar total y tax de la venta
            $tax = $total * 0.18; // 18% de IGV
            $sale->update([
                'total' => $total,
                'tax' => $tax,
                'status' => 'PAID'
            ]);

            \DB::commit();

            return redirect()->route('sales.show', $sale)
                ->with('success', 'Venta registrada exitosamente.');

        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->back()
                ->with('error', 'Error al registrar la venta: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $sale->load(['customer', 'user', 'saleDetails.product']);
        return view('sales.show', compact('sale'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        if ($sale->status !== 'PENDING') {
            return redirect()->route('sales.index')
                ->with('error', 'No se puede eliminar una venta que no está pendiente.');
        }

        try {
            \DB::beginTransaction();

            // Restaurar stock de productos
            foreach ($sale->saleDetails as $detail) {
                $detail->product->update([
                    'stock' => $detail->product->stock + $detail->quantity
                ]);
            }

            $sale->saleDetails()->delete();
            $sale->delete();

            \DB::commit();

            return redirect()->route('sales.index')
                ->with('success', 'Venta eliminada exitosamente.');

        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->back()
                ->with('error', 'Error al eliminar la venta: ' . $e->getMessage());
        }
    }
}
