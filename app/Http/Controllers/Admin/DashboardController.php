<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'today');

        // Calculate date range based on period
        $startDate = match($period) {
            'today' => now()->startOfDay(),
            'week' => now()->subDays(7),
            'month' => now()->startOfMonth(),
            'year' => now()->startOfYear(),
            default => now()->startOfDay(),
        };

        // Product Statistics
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $outOfStock = Product::where('stock', 0)->count();
        $lowStockProducts = Product::where('stock', '>', 0)
            ->where('stock', '<=', 10)
            ->count();

        // Order Statistics (using real Order model)
        $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
        $totalRevenue = \App\Models\Order::whereIn('status', ['delivered', 'shipped'])
            ->where('created_at', '>=', $startDate)
            ->sum('total');
        
        $currentOrders = \App\Models\Order::where('created_at', '>=', $startDate)->count();

        // User Statistics
        $totalClients = User::where('role', 'client')->count();
        $newCustomers = User::where('role', 'client')
            ->where('created_at', '>=', $startDate)
            ->count();

        // Calculate growth percentages
        $previousPeriodStart = match($period) {
            'today' => now()->subDay()->startOfDay(),
            'week' => now()->subDays(14),
            'month' => now()->subMonth()->startOfMonth(),
            'year' => now()->subYear()->startOfYear(),
            default => now()->subDay()->startOfDay(),
        };

        $previousRevenue = \App\Models\Order::whereIn('status', ['delivered', 'shipped'])
            ->whereBetween('created_at', [$previousPeriodStart, $startDate])
            ->sum('total');
        
        $previousOrders = \App\Models\Order::whereBetween('created_at', [$previousPeriodStart, $startDate])->count();

        $revenueGrowth = $previousRevenue > 0 ? round((($totalRevenue - $previousRevenue) / $previousRevenue) * 100, 1) : 0;
        $ordersGrowth = $previousOrders > 0 ? round((($currentOrders - $previousOrders) / $previousOrders) * 100, 1) : 0;
        $customersGrowth = $newCustomers > 0 ? round(($newCustomers / max($totalClients - $newCustomers, 1)) * 100, 1) : 0;

        // Recent orders from database
        $recentOrders = \App\Models\Order::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Prepare stats array
        $stats = [
            'period' => $period,
            'out_of_stock' => $outOfStock,
            'low_stock_products' => $lowStockProducts,
            'pending_orders' => $pendingOrders,
            'total_revenue' => $totalRevenue,
            'revenue_growth' => $revenueGrowth,
            'comparison_label' => match($period) {
                'today' => 'vs hier',
                'week' => 'vs semaine dernière',
                'month' => 'vs mois dernier',
                'year' => 'vs année dernière',
                default => 'vs hier',
            },
            'current_orders' => $currentOrders,
            'orders_growth' => $ordersGrowth,
            'active_products' => $activeProducts,
            'total_products' => $totalProducts,
            'total_clients' => $totalClients,
            'new_customers' => $newCustomers,
            'customers_growth' => $customersGrowth,
        ];

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
