<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // Datos ficticios más realistas
        $stats = [
            'today_sales' => 25850.75,
            'month_sales' => 847320.50,
            'total_products' => 324,
            'total_customers' => 156
        ];

        // Generar datos de ventas mensuales del último año
        $ventasPorMes = collect([
            ['mes' => 'Ene', 'total' => 756430],
            ['mes' => 'Feb', 'total' => 842150],
            ['mes' => 'Mar', 'total' => 927840],
            ['mes' => 'Abr', 'total' => 845620],
            ['mes' => 'May', 'total' => 932450],
            ['mes' => 'Jun', 'total' => 847320],
            ['mes' => 'Jul', 'total' => 956840],
            ['mes' => 'Ago', 'total' => 1023450],
            ['mes' => 'Sep', 'total' => 987650],
            ['mes' => 'Oct', 'total' => 1124530],
            ['mes' => 'Nov', 'total' => 1256840],
            ['mes' => 'Dic', 'total' => 1432650]
        ]);

        // Productos más vendidos con datos realistas
        $productosMasVendidos = collect([
            ['nombre' => 'iPhone 13 Pro', 'total' => 245],
            ['nombre' => 'Samsung S21', 'total' => 198],
            ['nombre' => 'MacBook Pro', 'total' => 156],
            ['nombre' => 'AirPods Pro', 'total' => 312],
            ['nombre' => 'iPad Air', 'total' => 178]
        ]);

        // Datos de ventas por categoría
        $ventasPorCategoria = [
            'labels' => ['Electrónicos', 'Computadoras', 'Accesorios', 'Tablets', 'Smartphones'],
            'data' => [584750, 423680, 321450, 245680, 678920]
        ];

        // Datos de ventas por hora (patrón realista de un día)
        $ventasPorHora = [
            'labels' => ['8am', '9am', '10am', '11am', '12pm', '1pm', '2pm', '3pm', '4pm', '5pm', '6pm', '7pm', '8pm'],
            'data' => [12500, 18700, 24500, 32800, 45600, 38700, 28900, 25600, 35700, 42800, 38900, 28400, 15600]
        ];

        // Tendencias de ventas
        $tendencias = [
            'daily' => 15.8,    // 15.8% más que ayer
            'monthly' => 8.5,    // 8.5% más que el mes pasado
            'products' => -3.2,  // 3.2% menos en stock
            'customers' => 5.7   // 5.7% más clientes
        ];

        return view('reports.index', compact(
            'stats',
            'ventasPorMes',
            'productosMasVendidos',
            'ventasPorCategoria',
            'ventasPorHora',
            'tendencias'
        ));
    }

    public function getData(Request $request)
    {
        $tipo = $request->get('tipo', 'ventas');
        $periodo = $request->get('periodo', 'diario');
        $fecha_inicio = $request->get('fecha_inicio', now()->subDays(30));
        $fecha_fin = $request->get('fecha_fin', now());

        switch ($tipo) {
            case 'ventas':
                return $this->getVentasData($periodo, $fecha_inicio, $fecha_fin);
            case 'productos':
                return $this->getProductosData($fecha_inicio, $fecha_fin);
            case 'categorias':
                return $this->getCategoriasData($fecha_inicio, $fecha_fin);
            default:
                return response()->json(['error' => 'Tipo de reporte no válido']);
        }
    }

    private function getVentasData($periodo, $fecha_inicio, $fecha_fin)
    {
        $groupBy = match($periodo) {
            'diario' => 'DATE(created_at)',
            'semanal' => 'YEARWEEK(created_at)',
            'mensual' => 'DATE_FORMAT(created_at, "%Y-%m")',
            default => 'DATE(created_at)'
        };

        return Venta::select(
            DB::raw("$groupBy as periodo"),
            DB::raw('COUNT(*) as total_ventas'),
            DB::raw('SUM(total) as total_monto')
        )
        ->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
        ->groupBy('periodo')
        ->orderBy('periodo')
        ->get();
    }

    private function getProductosData($fecha_inicio, $fecha_fin)
    {
        return DB::table('venta_detalles')
            ->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')
            ->select(
                'productos.nombre',
                DB::raw('SUM(venta_detalles.cantidad) as total_vendido'),
                DB::raw('SUM(venta_detalles.subtotal) as total_monto')
            )
            ->whereBetween('venta_detalles.created_at', [$fecha_inicio, $fecha_fin])
            ->groupBy('productos.id', 'productos.nombre')
            ->orderByDesc('total_vendido')
            ->limit(10)
            ->get();
    }

    private function getCategoriasData($fecha_inicio, $fecha_fin)
    {
        return DB::table('venta_detalles')
            ->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')
            ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->select(
                'categorias.nombre',
                DB::raw('COUNT(DISTINCT venta_detalles.venta_id) as total_ventas'),
                DB::raw('SUM(venta_detalles.subtotal) as total_monto')
            )
            ->whereBetween('venta_detalles.created_at', [$fecha_inicio, $fecha_fin])
            ->groupBy('categorias.id', 'categorias.nombre')
            ->get();
    }

    private function calcularGanancias($fechaInicio, $fechaFin)
    {
        return DB::table('sale_details')
            ->join('sales', 'sales.id', '=', 'sale_details.sale_id')
            ->join('products', 'products.id', '=', 'sale_details.product_id')
            ->whereBetween('sales.fecha', [$fechaInicio, $fechaFin])
            ->select(DB::raw('SUM((products.precio - products.precio_compra) * sale_details.quantity) as ganancia'))
            ->value('ganancia');
    }

    public function getDashboardData()
    {
        return response()->json([
            'ventas_hoy' => $this->getVentasHoy(),
            'ventas_mes' => $this->getVentasMes(),
            'productos_bajos' => $this->getProductosBajoStock(),
            'mejores_productos' => $this->getMejoresProductos(),
            'tendencia_ventas' => $this->getTendenciaVentas(),
            'ventas_por_hora' => $this->getVentasPorHora(),
            'ganancias_mes' => $this->getGananciasMes(),
            'top_categorias' => $this->getTopCategorias(),
        ]);
    }

    private function getVentasHoy()
    {
        return [
            'total' => Venta::whereDate('created_at', today())->count(),
            'monto' => Venta::whereDate('created_at', today())->sum('total'),
            'promedio' => Venta::whereDate('created_at', today())->avg('total'),
            'comparacion' => $this->getComparacionVentas('day'),
        ];
    }

    private function getVentasMes()
    {
        return [
            'total' => Venta::whereMonth('created_at', now()->month)->count(),
            'monto' => Venta::whereMonth('created_at', now()->month)->sum('total'),
            'promedio_diario' => Venta::whereMonth('created_at', now()->month)
                ->select(DB::raw('AVG(total_diario) as promedio'))
                ->fromSub(function ($query) {
                    $query->select(DB::raw('DATE(created_at) as fecha, SUM(total) as total_diario'))
                        ->from('ventas')
                        ->groupBy('fecha');
                }, 'daily_sales')
                ->value('promedio'),
            'comparacion' => $this->getComparacionVentas('month'),
        ];
    }

    private function getProductosBajoStock()
    {
        return collect([
            ['nombre' => 'iPhone 13 Pro Max', 'stock' => 5, 'stock_minimo' => 10],
            ['nombre' => 'Samsung Galaxy S22', 'stock' => 3, 'stock_minimo' => 8],
            ['nombre' => 'MacBook Pro M1', 'stock' => 2, 'stock_minimo' => 5],
            ['nombre' => 'AirPods Pro', 'stock' => 4, 'stock_minimo' => 15],
            ['nombre' => 'iPad Pro 12.9"', 'stock' => 6, 'stock_minimo' => 12]
        ]);
    }

    private function getMejoresProductos()
    {
        return collect([
            [
                'nombre' => 'iPhone 13 Pro',
                'total_vendido' => 245,
                'total_ventas' => 294000
            ],
            [
                'nombre' => 'Samsung S22 Ultra',
                'total_vendido' => 198,
                'total_ventas' => 237600
            ],
            [
                'nombre' => 'MacBook Pro 14"',
                'total_vendido' => 156,
                'total_ventas' => 312000
            ],
            [
                'nombre' => 'AirPods Pro',
                'total_vendido' => 312,
                'total_ventas' => 78000
            ],
            [
                'nombre' => 'iPad Air',
                'total_vendido' => 178,
                'total_ventas' => 142400
            ]
        ]);
    }

    private function getTendenciaVentas()
    {
        $datos = collect();
        $fecha = now()->subDays(30);
        $tendencia = 1000; // Valor base

        while ($fecha <= now()) {
            // Generar variación aleatoria pero con tendencia creciente
            $variacion = rand(-200, 300);
            $tendencia += $variacion;
            $ventas = max(500, $tendencia); // Mínimo 500 ventas

            $datos->push([
                'fecha' => $fecha->format('Y-m-d'),
                'total_ventas' => rand(50, 150), // Entre 50 y 150 ventas por día
                'total_monto' => $ventas * rand(50, 200) // Monto por venta entre $50 y $200
            ]);

            $fecha->addDay();
        }

        return $datos;
    }

    private function getVentasPorHora()
    {
        $horas = [];
        // Patrón realista de ventas durante el día
        $patronHoras = [
            8 => [20, 40],    // 8am: pocas ventas
            9 => [30, 60],    // 9am: aumenta
            10 => [40, 80],   // 10am: más movimiento
            11 => [50, 90],   // 11am: pico mañana
            12 => [60, 100],  // 12pm: hora pico
            13 => [50, 90],   // 1pm: almuerzo
            14 => [40, 80],   // 2pm: baja
            15 => [45, 85],   // 3pm: repunta
            16 => [55, 95],   // 4pm: pico tarde
            17 => [60, 100],  // 5pm: hora pico
            18 => [50, 90],   // 6pm: se mantiene
            19 => [40, 80],   // 7pm: baja
            20 => [30, 60],   // 8pm: cierre
        ];

        foreach ($patronHoras as $hora => $rango) {
            $ventas = rand($rango[0], $rango[1]);
            $horas[] = [
                'hora' => $hora,
                'total_ventas' => $ventas,
                'promedio_venta' => rand(5000, 15000) / 100 // Entre $50 y $150
            ];
        }

        return collect($horas);
    }

    private function getGananciasMes()
    {
        // Generar ganancias realistas para el mes
        $ventasDiarias = rand(80, 150); // Entre 80 y 150 ventas por día
        $diasMes = now()->daysInMonth;
        $ventasTotales = $ventasDiarias * $diasMes;
        
        $gananciaPromedio = rand(1500, 3000) / 100; // Entre $15 y $30 por venta
        $gananciaTotal = $ventasTotales * $gananciaPromedio;

        return (object)[
            'ganancia_total' => $gananciaTotal,
            'ganancia_promedio' => $gananciaPromedio,
            'ventas_totales' => $ventasTotales,
            'promedio_diario' => $ventasDiarias
        ];
    }

    private function getTopCategorias()
    {
        $categorias = [
            'Smartphones' => [800000, 450],
            'Laptops' => [1200000, 280],
            'Accesorios' => [350000, 890],
            'Tablets' => [480000, 320],
            'Smart TV' => [950000, 180],
            'Audio' => [280000, 560],
            'Gaming' => [580000, 340],
            'Wearables' => [320000, 420]
        ];

        $resultado = collect();
        foreach ($categorias as $nombre => $datos) {
            $resultado->push([
                'nombre' => $nombre,
                'total_ventas' => $datos[1],
                'total_monto' => $datos[0]
            ]);
        }

        return $resultado->sortByDesc('total_monto')->take(5);
    }

    private function getComparacionVentas($periodo)
    {
        $actual = Venta::when($periodo === 'day', function ($query) {
                return $query->whereDate('created_at', today());
            })
            ->when($periodo === 'month', function ($query) {
                return $query->whereMonth('created_at', now()->month);
            })
            ->sum('total');

        $anterior = Venta::when($periodo === 'day', function ($query) {
                return $query->whereDate('created_at', today()->subDay());
            })
            ->when($periodo === 'month', function ($query) {
                return $query->whereMonth('created_at', now()->subMonth()->month);
            })
            ->sum('total');

        $diferencia = $anterior > 0 ? (($actual - $anterior) / $anterior) * 100 : 0;

        return [
            'diferencia' => round($diferencia, 2),
            'tendencia' => $diferencia > 0 ? 'up' : 'down'
        ];
    }

    public function sales()
    {
        return view('reports.sales');
    }

    public function products()
    {
        return view('reports.products');
    }

    public function customers()
    {
        return view('reports.customers');
    }
} 