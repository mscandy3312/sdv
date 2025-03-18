<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')
            ->where('stock', '>', 0)
            ->paginate(12);
            
        $categorias = Categoria::all();
        
        return view('shop.index', compact('productos', 'categorias'));
    }

    public function addToCart($id)
    {
        $producto = Producto::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "nombre" => $producto->nombre,
                "quantity" => 1,
                "precio" => $producto->precio,
                "imagen" => $producto->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Producto agregado al carrito!');
    }

    public function cart()
    {
        return view('shop.cart');
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Carrito actualizado!');
    }

    public function removeFromCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back()->with('success', 'Producto eliminado del carrito!');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('shop.cart')->with('success', 'Carrito vaciado exitosamente');
    }
} 