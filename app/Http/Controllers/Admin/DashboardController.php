<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'today');

        // Mock data to ensure the front-end works without a database
        $stats = [
            'period' => $period,
            'out_of_stock' => 5,
            'low_stock_products' => 12,
            'pending_orders' => 8,
            'total_revenue' => $period === 'today' ? 12450 : 285600,
            'revenue_growth' => 15.4,
            'comparison_label' => $period === 'today' ? 'vs hier' : 'vs mois dernier',
            'current_orders' => $period === 'today' ? 24 : 452,
            'orders_growth' => 8.2,
            'active_products' => 145,
            'total_products' => 160,
            'total_clients' => 1250,
            'new_customers' => 45,
        ];

        // Mock recent orders
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
            (object)[
                'id' => 1022,
                'shipping_name' => 'Karim Benjelloun',
                'total' => 120.00,
                'status' => 'delivered',
                'created_at' => now()->subHours(5),
            ],
            (object)[
                'id' => 1021,
                'shipping_name' => 'Yasmine Idris',
                'total' => 2100.00,
                'status' => 'cancelled',
                'created_at' => now()->subDays(1),
            ],
        ]);

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
