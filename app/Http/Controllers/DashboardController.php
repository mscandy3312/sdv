<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Product;
use App\Models\Category;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas generales
        $ventasTotales = Sale::sum('total');
        $numeroVentas = Sale::count();
        $totalProductos = Product::count();
        $productosActivos = Product::where('status', true)->count();
        $totalClientes = Client::count();
        
        // Verificar si existe la columna created_at
        try {
            $clientesNuevos = Client::whereMonth('created_at', now()->month)->count();
        } catch (\Exception $e) {
            $clientesNuevos = 0; // valor por defecto si no existe la columna
        }
        
        $totalCategorias = Category::count();
        $productosMinStock = Product::where('stock', '<=', 10)->count();

        // Datos para el gráfico de ventas
        $ventasUltimos7Dias = Sale::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total) as total')
        )
        ->whereBetween('created_at', [now()->subDays(6), now()])
        ->groupBy('date')
        ->get();

        $ventasChart = [
            'labels' => $ventasUltimos7Dias->pluck('date')->map(function($date) {
                return Carbon::parse($date)->format('d/m');
            }),
            'data' => $ventasUltimos7Dias->pluck('total')
        ];

        // Top productos vendidos
        $topProductos = Product::select('products.*')
            ->join('sale_details', 'products.id', '=', 'sale_details.product_id')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->where('sales.status', 'PAID')
            ->groupBy('products.id')
            ->selectRaw('SUM(sale_details.quantity * sale_details.price) as total_ventas')
            ->selectRaw('COUNT(DISTINCT sales.id) as ventas_count')
            ->orderByDesc('ventas_count')
            ->limit(5)
            ->get();

        // Últimas ventas
        $ultimasVentas = Sale::with('client')
            ->latest()
            ->limit(5)
            ->get();

        // Productos bajo stock
        $productosBajoStock = Product::with('categoria')
            ->where('stock', '<=', 10)
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'ventasTotales',
            'numeroVentas',
            'totalProductos',
            'productosActivos',
            'totalClientes',
            'clientesNuevos',
            'totalCategorias',
            'productosMinStock',
            'ventasChart',
            'topProductos',
            'ultimasVentas',
            'productosBajoStock'
        ));
    }

    public function getData()
    {
        $ventasHoy = Sale::whereDate('created_at', today())
            ->where('status', Sale::STATUS_PAID)
            ->count();

        $ventasAyer = Sale::whereDate('created_at', today()->subDay())
            ->where('status', Sale::STATUS_PAID)
            ->count();

        $ventasMes = Sale::whereMonth('created_at', now()->month)
            ->where('status', Sale::STATUS_PAID)
            ->count();

        $ventasMesAnterior = Sale::whereMonth('created_at', now()->subMonth()->month)
            ->where('status', Sale::STATUS_PAID)
            ->count();

        $tendenciaVentas = Sale::selectRaw('DATE(created_at) as fecha, COUNT(*) as total_ventas, SUM(total) as total_monto')
            ->where('status', Sale::STATUS_PAID)
            ->whereDate('created_at', '>=', now()->subDays(7))
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        $mejoresProductos = Product::select([
            'products.id',
            'products.name as nombre',
            'products.code',
            'products.price',
            'products.stock',
            DB::raw('COUNT(sale_details.id) as total_vendido'),
            DB::raw('COALESCE(SUM(sale_details.subtotal), 0) as total_ventas')
        ])
        ->leftJoin('sale_details', 'products.id', '=', 'sale_details.product_id')
        ->leftJoin('sales', 'sale_details.sale_id', '=', 'sales.id')
        ->where('sales.status', Sale::STATUS_PAID)
        ->groupBy('products.id', 'products.name', 'products.code', 'products.price', 'products.stock')
        ->orderByDesc('total_vendido')
        ->limit(5)
        ->get();

        $topCategorias = Category::select([
            'categories.id',
            'categories.name as nombre',
            DB::raw('COUNT(DISTINCT sale_details.id) as total_ventas'),
            DB::raw('COALESCE(SUM(sale_details.subtotal), 0) as total_monto')
        ])
        ->leftJoin('products', 'categories.id', '=', 'products.category_id')
        ->leftJoin('sale_details', 'products.id', '=', 'sale_details.product_id')
        ->leftJoin('sales', 'sale_details.sale_id', '=', 'sales.id')
        ->where('sales.status', Sale::STATUS_PAID)
        ->groupBy('categories.id', 'categories.name')
        ->orderByDesc('total_ventas')
        ->limit(5)
        ->get();

        $productosBajos = Product::where('stock', '<=', 5)
            ->orderBy('stock')
            ->limit(5)
            ->get()
            ->map(fn($producto) => [
                'nombre' => $producto->name,
                'stock' => $producto->stock,
                'stock_minimo' => 5
            ]);

        $gananciasMes = Sale::where('status', Sale::STATUS_PAID)
            ->whereMonth('created_at', now()->month)
            ->sum('total');

        return response()->json([
            'ventasHoy' => $ventasHoy,
            'ventasAyer' => $ventasAyer,
            'ventasMes' => $ventasMes,
            'ventasMesAnterior' => $ventasMesAnterior,
            'tendencia_ventas' => $tendenciaVentas,
            'mejores_productos' => $mejoresProductos,
            'top_categorias' => $topCategorias,
            'productos_bajos' => $productosBajos,
            'ganancias_mes' => $gananciasMes,
            'comparacion_ventas' => [
                'hoy' => [
                    'actual' => $ventasHoy,
                    'anterior' => $ventasAyer,
                    'diferencia' => $ventasHoy - $ventasAyer,
                    'porcentaje' => $ventasAyer > 0 ? (($ventasHoy - $ventasAyer) / $ventasAyer) * 100 : 0
                ],
                'mes' => [
                    'actual' => $ventasMes,
                    'anterior' => $ventasMesAnterior,
                    'diferencia' => $ventasMes - $ventasMesAnterior,
                    'porcentaje' => $ventasMesAnterior > 0 ? (($ventasMes - $ventasMesAnterior) / $ventasMesAnterior) * 100 : 0
                ]
            ]
        ]);
    }

    public function exportar(Request $request)
    {
        $formato = $request->formato;
        $tipo = $request->tipo;
        
        $data = $this->getData();
        
        if (!$data) {
            return response()->json(['error' => 'No hay datos disponibles'], 404);
        }

        $data = $data->original;

        return match($formato) {
            'excel' => $this->exportarCSV($data, $tipo),
            'pdf' => $this->exportarPDF($data, $tipo),
            default => response()->json(['error' => 'Formato no válido'])
        };
    }

    private function exportarCSV($data, $tipo)
    {
        $filename = "dashboard_{$tipo}_" . date('Y-m-d') . '.csv';
        $handle = fopen('php://temp', 'r+');
        fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

        switch($tipo) {
            case 'ventas':
                fputcsv($handle, ['Fecha', 'Total Ventas', 'Monto']);
                foreach ($data['tendencia_ventas'] as $venta) {
                    fputcsv($handle, [
                        $venta['fecha'],
                        $venta['total_ventas'],
                        $venta['total_monto']
                    ]);
                }
                break;

            case 'productos':
                fputcsv($handle, ['Producto', 'Total Vendido', 'Total Ventas']);
                foreach ($data['mejores_productos'] as $producto) {
                    fputcsv($handle, [
                        $producto['nombre'],
                        $producto['total_vendido'],
                        $producto['total_ventas']
                    ]);
                }
                break;

            case 'categorias':
                fputcsv($handle, ['Categoría', 'Total Ventas', 'Monto Total']);
                foreach ($data['top_categorias'] as $categoria) {
                    fputcsv($handle, [
                        $categoria['nombre'],
                        $categoria['total_ventas'],
                        $categoria['total_monto']
                    ]);
                }
                break;

            case 'stock':
                fputcsv($handle, ['Producto', 'Stock Actual', 'Stock Mínimo']);
                foreach ($data['productos_bajos'] as $producto) {
                    fputcsv($handle, [
                        $producto['nombre'],
                        $producto['stock'],
                        $producto['stock_minimo']
                    ]);
                }
                break;
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response($csv)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    private function exportarPDF($data, $tipo)
    {
        try {
            // Obtener datos según el tipo
            switch($tipo) {
                case 'ventas':
                    $datos = Sale::with('client')
                        ->where('status', Sale::STATUS_PAID)
                        ->whereDate('created_at', '>=', now()->subDays(7))
                        ->orderBy('created_at', 'desc')
                        ->get();
                    break;

                case 'productos':
                    $datos = SaleDetail::with('product')
                        ->select('product_id', DB::raw('SUM(quantity) as total_vendido'), DB::raw('SUM(subtotal) as total_ventas'))
                        ->whereHas('sale', function($q) {
                            $q->where('status', Sale::STATUS_PAID);
                        })
                        ->groupBy('product_id')
                        ->orderByDesc('total_vendido')
                        ->limit(10)
                        ->get();
                    break;

                case 'categorias':
                    $datos = Category::withCount(['products' => function($q) {
                        $q->whereHas('saleDetails.sale', function($q) {
                            $q->where('status', Sale::STATUS_PAID);
                        });
                    }])->get();
                    break;

                case 'stock':
                    $datos = Product::where('stock', '<=', 5)
                        ->orderBy('stock')
                        ->get();
                    break;

                default:
                    return back()->with('error', 'Tipo de reporte no válido');
            }

            // Generar contenido del PDF
            $content = "Reporte de " . ucfirst($tipo) . "\n";
            $content .= "Fecha: " . date('Y-m-d') . "\n\n";

            foreach ($datos as $dato) {
                switch($tipo) {
                    case 'ventas':
                        $content .= sprintf(
                            "Venta #%s - Cliente: %s - Total: $%s\n",
                            $dato->code,
                            $dato->client->name,
                            number_format($dato->total, 2)
                        );
                        break;

                    case 'productos':
                        $content .= sprintf(
                            "Producto: %s - Vendidos: %s - Total: $%s\n",
                            $dato->product->name,
                            $dato->total_vendido,
                            number_format($dato->total_ventas, 2)
                        );
                        break;

                    case 'categorias':
                        $content .= sprintf(
                            "Categoría: %s - Productos: %s\n",
                            $dato->name,
                            $dato->products_count
                        );
                        break;

                    case 'stock':
                        $content .= sprintf(
                            "Producto: %s - Stock: %s\n",
                            $dato->name,
                            $dato->stock
                        );
                        break;
                }
            }

            // Generar archivo de texto
            $tempFile = tempnam(sys_get_temp_dir(), 'txt_');
            file_put_contents($tempFile, $content);

            return Response::download($tempFile, "reporte_{$tipo}_" . date('Y-m-d') . '.txt', [
                'Content-Type' => 'text/plain'
            ])->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            \Log::error('Error generando reporte: ' . $e->getMessage());
            return back()->with('error', 'Error generando reporte: ' . $e->getMessage());
        }
    }
}

