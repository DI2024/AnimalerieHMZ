<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => 1250,
            'pending' => 8,
            'revenue' => 285600,
            'average' => 450,
        ];

        $orders = collect([
            (object)[
                'id' => 1024, 
                'order_number' => 'ORD-1024',
                'shipping_name' => 'Ahmed Alaoui', 
                'total' => 450.00, 
                'discount' => 0,
                'status' => 'pending', 
                'created_at' => now()->subMinutes(15),
                'items' => collect([])
            ],
            (object)[
                'id' => 1023, 
                'order_number' => 'ORD-1023',
                'shipping_name' => 'Sara Mansouri', 
                'total' => 890.50, 
                'discount' => 50,
                'status' => 'confirmed', 
                'created_at' => now()->subHours(2),
                'items' => collect([])
            ],
        ]);

        // Mock pagination
        $orders = new \Illuminate\Pagination\LengthAwarePaginator($orders, $orders->count(), 10);
        $orders->withPath(route('admin.orders.index'));

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    public function show($id)
    {
        $order = (object)[
            'id' => $id,
            'shipping_name' => 'Ahmed Alaoui',
            'total' => 450.00,
            'status' => 'pending',
            'created_at' => now()->subMinutes(15),
            'items' => collect([]),
            'user' => (object)['name' => 'Ahmed Alaoui', 'email' => 'ahmed@example.com']
        ];
        return view('admin.orders.show', compact('order'));
    }
}
