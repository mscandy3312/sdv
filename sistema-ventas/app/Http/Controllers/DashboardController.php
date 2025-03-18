<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas de ventas
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        $stats = [
            'today_sales' => Sale::whereDate('created_at', $today)->sum('total'),
            'month_sales' => Sale::whereMonth('created_at', $today->month)
                                ->whereYear('created_at', $today->year)
                                ->sum('total'),
            'total_products' => Product::count(),
            'total_customers' => Customer::count(),
            'low_stock_products' => Product::where('stock', '<=', 10)->count(),
            'recent_sales' => Sale::with(['customer', 'user'])
                                ->latest()
                                ->take(5)
                                ->get(),
            'top_products' => DB::table('sale_details')
                                ->select('products.name', DB::raw('SUM(sale_details.quantity) as total_sold'))
                                ->join('products', 'products.id', '=', 'sale_details.product_id')
                                ->groupBy('products.id', 'products.name')
                                ->orderByDesc('total_sold')
                                ->take(5)
                                ->get(),
            'sales_chart' => Sale::select(
                                DB::raw('DATE(created_at) as date'),
                                DB::raw('SUM(total) as total')
                            )
                            ->whereBetween('created_at', [$startOfMonth, now()])
                            ->groupBy('date')
                            ->orderBy('date')
                            ->get()
        ];

        return view('dashboard', compact('stats'));
    }
}
