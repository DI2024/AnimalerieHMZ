<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Show cart page
     */
    public function show()
    {
        return view('cart');
    }

    /**
     * Get cart items from session
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::with('category')->find($productId);
            if ($product) {
                $cartItems[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'price' => $product->price,
                    'image' => $product->image,
                    'category' => $product->category ? $product->category->name : '',
                    'quantity' => $quantity,
                    'stock' => $product->stock,
                    'subtotal' => $product->price * $quantity,
                ];
                $total += $product->price * $quantity;
            }
        }

        return response()->json([
            'success' => true,
            'cart' => $cartItems,
            'total' => $total,
            'count' => count($cartItems),
        ]);
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1',
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

        $product = Product::find($productId);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produit non trouvé',
            ], 404);
        }

        // Check stock
        if ($product->stock < $quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stock insuffisant',
            ], 400);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté au panier',
            'cart_count' => count($cart),
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity;

        $cart = session()->get('cart', []);

        if ($quantity == 0) {
            unset($cart[$productId]);
        } else {
            $product = Product::find($productId);
            if ($product && $product->stock >= $quantity) {
                $cart[$productId] = $quantity;
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock insuffisant',
                ], 400);
            }
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Panier mis à jour',
            'cart_count' => count($cart),
        ]);
    }

    /**
     * Remove product from cart
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $request->product_id;
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Produit retiré du panier',
            'cart_count' => count($cart),
        ]);
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Panier vidé',
        ]);
    }

    /**
     * Add pack products to cart
     */
    public function addPack(Request $request)
    {
        $request->validate([
            'offer_id' => 'required|exists:offers,id',
        ]);

        $offer = \App\Models\Offer::with('products')->find($request->offer_id);
        if (!$offer || $offer->type !== 'pack' || !$offer->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Pack non trouvé ou inactif',
            ], 404);
        }

        $cart = session()->get('cart', []);
        $addedCount = 0;

        foreach ($offer->products as $product) {
            if ($product->is_active && $product->stock > 0) {
                $productId = $product->id;
                if (isset($cart[$productId])) {
                    $cart[$productId] += 1;
                } else {
                    $cart[$productId] = 1;
                }
                $addedCount++;
            }
        }

        if ($addedCount === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Aucun produit du pack n\'est disponible en stock',
            ], 400);
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Pack ajouté au panier',
            'cart_count' => count($cart),
        ]);
    }
}
