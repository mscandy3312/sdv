<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Client;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VentasExport;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Sale::with(['client', 'details.product'])->paginate(10);
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clients = Client::all();
        $products = Product::where('stock', '>', 0)->get();
        return view('ventas.create', compact('products', 'clients'));
    }

    public function store(Request $request)
    {
        \Log::info('Datos recibidos:', $request->all());

        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'productos' => 'required|array|min:1',
            'cantidades' => 'required|array|min:1',
        ]);

        try {
            \DB::beginTransaction();
            
            \Log::info('Client ID recibido:', [
                'client_id' => $request->client_id,
                'tipo' => gettype($request->client_id)
            ]);

            $codigoVenta = 'V-' . date('Ymd') . '-' . str_pad(Sale::count() + 1, 4, '0', STR_PAD_LEFT);

            // Crear la venta
            $venta = Sale::create([
                'code' => $codigoVenta,
                'clients_id' => (int)$request->client_id,
                'user_id' => auth()->id(),
                'total' => 0,
                'tax' => 0,
                'status' => Sale::STATUS_PENDING
            ]);

            \Log::info('Venta creada:', $venta->toArray());

            $total = 0;

            // Procesar cada producto
            foreach($request->productos as $index => $productoId) {
                $product = Product::findOrFail($productoId);
                $cantidad = $request->cantidades[$index];
                
                if($product->stock < $cantidad) {
                    throw new \Exception("Stock insuficiente para el producto: {$product->name}");
                }

                $subtotal = $product->price * $cantidad;
                
                // Crear detalle de venta
                $detalle = $venta->details()->create([
                    'product_id' => $product->id,
                    'quantity' => $cantidad,
                    'price' => $product->price,
                    'subtotal' => $subtotal
                ]);

                \Log::info('Detalle creado:', $detalle->toArray());

                // Actualizar stock
                $product->decrement('stock', $cantidad);
                
                $total += $subtotal;
            }

            // Calcular impuesto (por ejemplo, 18%)
            $tax = $total * 0.18;

            // Actualizar total de la venta
            $venta->update([
                'total' => $total,
                'tax' => $tax,
                'status' => Sale::STATUS_PAID
            ]);

            \DB::commit();

            \Log::info('Venta completada exitosamente');

            return redirect()->route('ventas.index')
                ->with('success', 'Venta registrada exitosamente');

        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error('Error en venta: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()
                ->with('error', 'Error al registrar la venta: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Sale $venta)
    {
        $venta->load(['client', 'details.product']);
        return view('ventas.show', compact('venta'));
    }

    public function destroy(Sale $venta)
    {
        $venta->delete();
        return redirect()->route('ventas.index')
            ->with('success', 'Venta eliminada exitosamente');
    }

    public function generarPDF(Sale $venta)
    {
        $pdf = PDF::loadView('ventas.pdf', compact('venta'));
        return $pdf->stream('venta-' . str_pad($venta->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }

    public function buscarProducto(Request $request)
    {
        \Log::info('Búsqueda recibida:', ['search' => $request->search]); // Debug

        if (!$request->ajax()) {
            return response()->json(['error' => 'Solo se permiten peticiones AJAX'], 400);
        }

        $search = $request->get('search');
        
        try {
            $productos = Product::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('code', 'LIKE', "%{$search}%");
            })
            ->where('stock', '>', 0)
            ->get();

            $resultado = $productos->map(function($product) {
                return [
                    'id' => $product->id,
                    'nombre' => $product->name,
                    'precio' => (float)$product->price,
                    'stock' => (int)$product->stock
                ];
            });

            \Log::info('Productos encontrados:', $resultado->toArray()); // Debug

            return response()->json($resultado);

        } catch (\Exception $e) {
            \Log::error('Error en búsqueda:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function exportar($formato)
    {
        try {
            $ventas = Sale::with(['client', 'details.product'])->get();

            if ($formato === 'csv') {
                $headers = [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename=ventas.csv',
                ];

                $callback = function() use ($ventas) {
                    $file = fopen('php://output', 'w');
                    
                    // Encabezados
                    fputcsv($file, ['Código', 'Cliente', 'Fecha', 'Total', 'Estado']);
                    
                    // Datos
                    foreach ($ventas as $venta) {
                        fputcsv($file, [
                            $venta->code,
                            $venta->client->name,
                            $venta->created_at->format('d/m/Y H:i'),
                            number_format($venta->total, 2),
                            $venta->status
                        ]);
                    }
                    
                    fclose($file);
                };

                return response()->stream($callback, 200, $headers);
            }

            if ($formato === 'txt') {
                $content = "REPORTE DE VENTAS\n\n";
                $content .= "Fecha de generación: " . now()->format('d/m/Y H:i') . "\n";
                $content .= str_repeat("=", 50) . "\n\n";

                foreach ($ventas as $venta) {
                    $content .= "Código: " . $venta->code . "\n";
                    $content .= "Cliente: " . $venta->client->name . "\n";
                    $content .= "Fecha: " . $venta->created_at->format('d/m/Y H:i') . "\n";
                    $content .= "Total: $" . number_format($venta->total, 2) . "\n";
                    $content .= "Estado: " . $venta->status . "\n";
                    $content .= str_repeat("-", 30) . "\n";
                }

                return response($content)
                    ->header('Content-Type', 'text/plain')
                    ->header('Content-Disposition', 'attachment; filename=ventas.txt');
            }

            return back()->with('error', 'Formato no soportado');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al exportar: ' . $e->getMessage());
        }
    }
}
