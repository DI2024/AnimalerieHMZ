<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Show checkout page
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Votre panier est vide');
        }

        $cartItems = [];
        $subtotal = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::with('category')->find($productId);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity,
                ];
                $subtotal += $product->price * $quantity;
            }
        }

        $shippingCost = $subtotal >= 100 ? 0 : 15; // Free shipping over 100€
        $tax = $subtotal * 0.20; // 20% TVA
        $total = $subtotal + $shippingCost + $tax;

        return view('checkout', compact('cartItems', 'subtotal', 'shippingCost', 'tax', 'total'));
    }

    /**
     * Process checkout and create order
     */
    public function process(Request $request)
    {
        $validated = $request->validate([
            'shipping_first_name' => 'required|string|max:255',
            'shipping_last_name' => 'required|string|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address_line_1' => 'required|string|max:255',
            'shipping_address_line_2' => 'nullable|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_postal_code' => 'required|string|max:10',
            'shipping_country' => 'required|string|max:255',
            'payment_method' => 'required|in:card,paypal,bank_transfer,cash_on_delivery',
            'customer_notes' => 'nullable|string|max:1000',
            'billing_same_as_shipping' => 'boolean',
            'billing_first_name' => 'required_if:billing_same_as_shipping,false|string|max:255',
            'billing_last_name' => 'required_if:billing_same_as_shipping,false|string|max:255',
            'billing_address_line_1' => 'required_if:billing_same_as_shipping,false|string|max:255',
            'billing_address_line_2' => 'nullable|string|max:255',
            'billing_city' => 'required_if:billing_same_as_shipping,false|string|max:255',
            'billing_postal_code' => 'required_if:billing_same_as_shipping,false|string|max:10',
            'billing_country' => 'required_if:billing_same_as_shipping,false|string|max:255',
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Votre panier est vide',
            ], 400);
        }

        DB::beginTransaction();

        try {
            // Calculate totals
            $subtotal = 0;
            $orderItems = [];

            foreach ($cart as $productId => $quantity) {
                $product = Product::find($productId);
                if (!$product) {
                    throw new \Exception("Produit non trouvé: {$productId}");
                }

                if ($product->stock < $quantity) {
                    throw new \Exception("Stock insuffisant pour: {$product->name}");
                }

                $itemSubtotal = $product->price * $quantity;
                $subtotal += $itemSubtotal;

                $orderItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'subtotal' => $itemSubtotal,
                ];
            }

            $shippingCost = $subtotal >= 100 ? 0 : 15;
            $tax = $subtotal * 0.20;
            $total = $subtotal + $shippingCost + $tax;

            // Create order
            $orderData = [
                'user_id' => auth()->id(),
                'shipping_first_name' => $validated['shipping_first_name'],
                'shipping_last_name' => $validated['shipping_last_name'],
                'shipping_email' => $validated['shipping_email'],
                'shipping_phone' => $validated['shipping_phone'],
                'shipping_address_line_1' => $validated['shipping_address_line_1'],
                'shipping_address_line_2' => $validated['shipping_address_line_2'] ?? null,
                'shipping_city' => $validated['shipping_city'],
                'shipping_postal_code' => $validated['shipping_postal_code'],
                'shipping_country' => $validated['shipping_country'],
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'tax' => $tax,
                'total' => $total,
                'payment_method' => $validated['payment_method'],
                'customer_notes' => $validated['customer_notes'] ?? null,
            ];

            // Handle billing address
            if ($request->billing_same_as_shipping) {
                $orderData['billing_first_name'] = $validated['shipping_first_name'];
                $orderData['billing_last_name'] = $validated['shipping_last_name'];
                $orderData['billing_address_line_1'] = $validated['shipping_address_line_1'];
                $orderData['billing_address_line_2'] = $validated['shipping_address_line_2'] ?? null;
                $orderData['billing_city'] = $validated['shipping_city'];
                $orderData['billing_postal_code'] = $validated['shipping_postal_code'];
                $orderData['billing_country'] = $validated['shipping_country'];
            } else {
                $orderData['billing_first_name'] = $validated['billing_first_name'];
                $orderData['billing_last_name'] = $validated['billing_last_name'];
                $orderData['billing_address_line_1'] = $validated['billing_address_line_1'];
                $orderData['billing_address_line_2'] = $validated['billing_address_line_2'] ?? null;
                $orderData['billing_city'] = $validated['billing_city'];
                $orderData['billing_postal_code'] = $validated['billing_postal_code'];
                $orderData['billing_country'] = $validated['billing_country'];
            }

            $order = Order::create($orderData);

            // Create order items and update stock
            foreach ($orderItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'product_name' => $item['product']->name,
                    'product_sku' => $item['product']->sku,
                    'product_image' => $item['product']->image,
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['subtotal'],
                ]);

                // Update product stock
                $item['product']->decrement('stock', $item['quantity']);
            }

            DB::commit();

            // Clear cart
            session()->forget('cart');

            return response()->json([
                'success' => true,
                'message' => 'Commande créée avec succès',
                'order_number' => $order->order_number,
                'redirect' => route('orders.confirmation', $order->order_number),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Show order confirmation page
     */
    public function confirmation($orderNumber)
    {
        $order = Order::with('items.product')
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        return view('checkout-confirmation', compact('order'));
    }
}
