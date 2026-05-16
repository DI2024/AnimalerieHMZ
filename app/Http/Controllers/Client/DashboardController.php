<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get user statistics
        $stats = [
            'total_orders' => $user->orders()->count(),
            'pending_orders' => $user->orders()->where('status', 'pending')->count(),
            'total_spent' => $user->orders()->where('payment_status', 'paid')->sum('total'),
        ];

        // Get recent orders
        $recentOrders = $user->orders()
            ->with('items')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('client.dashboard', compact('user', 'stats', 'recentOrders'));
    }
}
