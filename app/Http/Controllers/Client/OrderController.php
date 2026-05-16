<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display user's orders
     */
    public function index()
    {
        $orders = Order::with('items')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('client.orders.index', compact('orders'));
    }

    /**
     * Display specific order
     */
    public function show($orderNumber)
    {
        $order = Order::with('items.product')
            ->where('order_number', $orderNumber)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('client.orders.show', compact('order'));
    }

    /**
     * Track order by order number (no auth required)
     */
    public function track(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string',
            'email' => 'required|email',
        ]);

        $order = Order::with('items.product')
            ->where('order_number', $request->order_number)
            ->where('shipping_email', $request->email)
            ->first();

        if (!$order) {
            return back()->with('error', 'Commande non trouvée. Vérifiez votre numéro de commande et email.');
        }

        return view('client.orders.track', compact('order'));
    }
}
