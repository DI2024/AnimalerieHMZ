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
            'week' => now()->startOfWeek(),
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

        // New products in period
        $newProducts = Product::where('created_at', '>=', $startDate)->count();

        // Featured products
        $featuredProducts = Product::where('is_featured', true)->count();
        $bestsellers = Product::where('is_bestseller', true)->count();
        $newArrivals = Product::where('is_new', true)->count();

        // Category Statistics
        $totalCategories = Category::count();
        $activeCategories = Category::where('is_active', true)->count();

        // User Statistics
        $totalClients = User::count();
        $newCustomers = User::where('created_at', '>=', $startDate)->count();

        // Calculate growth percentages (mock for now since we don't have historical data)
        $productsGrowth = $newProducts > 0 ? round(($newProducts / max($totalProducts - $newProducts, 1)) * 100, 1) : 0;
        $customersGrowth = $newCustomers > 0 ? round(($newCustomers / max($totalClients - $newCustomers, 1)) * 100, 1) : 0;

        // Top categories by product count
        $topCategories = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->take(5)
            ->get();

        // Recent products
        $recentProducts = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Low stock alerts
        $lowStockAlerts = Product::with('category')
            ->where('stock', '>', 0)
            ->where('stock', '<=', 10)
            ->orderBy('stock', 'asc')
            ->take(10)
            ->get();

        // Out of stock products
        $outOfStockProducts = Product::with('category')
            ->where('stock', 0)
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        // Prepare stats array
        $stats = [
            'period' => $period,
            'out_of_stock' => $outOfStock,
            'low_stock_products' => $lowStockProducts,
            'pending_orders' => 0, // Will be implemented in Phase 4
            'total_revenue' => 0, // Will be implemented in Phase 4
            'revenue_growth' => 0,
            'comparison_label' => match($period) {
                'today' => 'vs hier',
                'week' => 'vs semaine dernière',
                'month' => 'vs mois dernier',
                'year' => 'vs année dernière',
                default => 'vs hier',
            },
            'current_orders' => 0, // Will be implemented in Phase 4
            'orders_growth' => 0,
            'active_products' => $activeProducts,
            'total_products' => $totalProducts,
            'total_clients' => $totalClients,
            'new_customers' => $newCustomers,
            'products_growth' => $productsGrowth,
            'customers_growth' => $customersGrowth,
            'featured_products' => $featuredProducts,
            'bestsellers' => $bestsellers,
            'new_arrivals' => $newArrivals,
            'total_categories' => $totalCategories,
            'active_categories' => $activeCategories,
        ];

        // Mock recent orders (will be real in Phase 4)
        $recentOrders = collect([
            (object)[
                'id' => 1024,
                'shipping_name' => 'Ahmed Alaoui',
                'total' => 450.00,
                'status' => 'pending',
                'created_at' => now()->subMinutes(15),
            ],
            (object)[
                'id' => 1023,
                'shipping_name' => 'Sara Mansouri',
                'total' => 890.50,
                'status' => 'confirmed',
                'created_at' => now()->subHours(2),
            ],
        ]);

        return view('admin.dashboard', compact(
            'stats',
            'recentOrders',
            'topCategories',
            'recentProducts',
            'lowStockAlerts',
            'outOfStockProducts'
        ));
    }
}
