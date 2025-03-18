<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Estadísticas generales para el dashboard
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();

        $stats = [
            'today_sales' => Sale::whereDate('created_at', $today)->sum('total'),
            'month_sales' => Sale::whereMonth('created_at', $thisMonth->month)
                                ->whereYear('created_at', $thisMonth->year)
                                ->sum('total'),
            'total_products' => Product::count(),
            'total_customers' => Customer::count(),
        ];

        return view('reports.index', compact('stats'));
    }

    public function sales(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth());

        $sales = Sale::whereBetween('created_at', [$startDate, $endDate])
                    ->with(['customer', 'user'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        $dailySales = Sale::whereBetween('created_at', [$startDate, $endDate])
                         ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))
                         ->groupBy('date')
                         ->orderBy('date')
                         ->get();

        return view('reports.sales', compact('sales', 'dailySales', 'startDate', 'endDate'));
    }

    public function products(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth());

        $topProducts = DB::table('sale_details')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->select(
                'products.name',
                DB::raw('SUM(sale_details.quantity) as total_quantity'),
                DB::raw('SUM(sale_details.quantity * sale_details.price) as total_amount')
            )
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_quantity', 'desc')
            ->limit(10)
            ->get();

        $lowStock = Product::where('stock', '<=', 10)
                          ->orderBy('stock')
                          ->get();

        return view('reports.products', compact('topProducts', 'lowStock', 'startDate', 'endDate'));
    }

    public function customers(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth());

        $topCustomers = DB::table('sales')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->select(
                'customers.name',
                'customers.email',
                DB::raw('COUNT(sales.id) as total_sales'),
                DB::raw('SUM(sales.total) as total_amount')
            )
            ->groupBy('customers.id', 'customers.name', 'customers.email')
            ->orderBy('total_amount', 'desc')
            ->limit(10)
            ->get();

        return view('reports.customers', compact('topCustomers', 'startDate', 'endDate'));
    }
}
