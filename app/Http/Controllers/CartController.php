<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Offer;
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

        foreach ($cart as $key => $quantity) {
            if (strpos($key, 'pack_') === 0) {
                // It's a pack
                $packId = substr($key, 5);
                $pack = Offer::with('products')->find($packId);
                if ($pack) {
                    $stockLimit = $this->getPackStockLimit($pack);
                    $cartItems[] = [
                        'id' => $key,
                        'pack_id' => $pack->id,
                        'name' => $pack->title,
                        'slug' => null,
                        'price' => (float)$pack->pack_price,
                        'image' => $pack->image 
                            ? (filter_var($pack->image, FILTER_VALIDATE_URL) ? $pack->image : 'storage/' . $pack->image)
                            : 'images/placeholder.svg',
                        'category' => 'Pack Spécial',
                        'quantity' => $quantity,
                        'stock' => $stockLimit,
                        'subtotal' => (float)$pack->pack_price * $quantity,
                        'is_pack' => true,
                        'products' => $pack->products->map(function($p) {
                            return [
                                'id' => $p->id,
                                'name' => $p->name,
                                'price' => (float)$p->price,
                            ];
                        })->toArray(),
                    ];
                    $total += $pack->pack_price * $quantity;
                }
            } else {
                // Normal product
                $product = Product::with('category')->find($key);
                if ($product) {
                    $cartItems[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'price' => (float)$product->price,
                        'image' => $product->image_url,
                        'category' => $product->category ? $product->category->name : '',
                        'quantity' => $quantity,
                        'stock' => $product->stock,
                        'subtotal' => (float)$product->price * $quantity,
                        'is_pack' => false,
                    ];
                    $total += $product->price * $quantity;
                }
            }
        }

        return response()->json([
            'success' => true,
            'cart' => $cartItems,
            'total' => $total,
            'count' => array_sum($cart),
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
            'cart_count' => array_sum($cart),
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string',
            'quantity' => 'required|integer|min:0',
        ]);

        $key = $request->product_id;
        $quantity = $request->quantity;

        $cart = session()->get('cart', []);

        if (strpos($key, 'pack_') === 0) {
            if ($quantity == 0) {
                unset($cart[$key]);
            } else {
                $packId = substr($key, 5);
                $pack = Offer::with('products')->find($packId);
                if (!$pack || $pack->type !== 'pack' || !$pack->is_active) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Pack non trouvé',
                    ], 404);
                }

                // Check stock of components
                foreach ($pack->products as $product) {
                    if ($product->stock < $quantity) {
                        return response()->json([
                            'success' => false,
                            'message' => "Le stock pour le produit '{$product->name}' inclus dans ce pack est insuffisant.",
                        ], 400);
                    }
                }
                $cart[$key] = $quantity;
            }
        } else {
            $productId = $key;
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
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Panier mis à jour',
            'cart_count' => array_sum($cart),
        ]);
    }

    /**
     * Remove product from cart
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string',
        ]);

        $productId = $request->product_id;
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Article retiré du panier',
            'cart_count' => array_sum($cart),
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
            'quantity' => 'integer|min:1',
        ]);

        $packId = $request->offer_id;
        $quantity = $request->quantity ?? 1;

        $offer = Offer::with('products')->find($packId);
        if (!$offer || $offer->type !== 'pack' || !$offer->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Pack non trouvé ou inactif',
            ], 404);
        }

        // Check stock of components
        foreach ($offer->products as $product) {
            if (!$product->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => "Le produit '{$product->name}' inclus dans ce pack n'est plus actif.",
                ], 400);
            }
            if ($product->stock < $quantity) {
                return response()->json([
                    'success' => false,
                    'message' => "Stock insuffisant pour le produit '{$product->name}' inclus dans ce pack.",
                ], 400);
            }
        }

        $cart = session()->get('cart', []);
        $key = 'pack_' . $offer->id;

        if (isset($cart[$key])) {
            $newQuantity = $cart[$key] + $quantity;
            foreach ($offer->products as $product) {
                if ($product->stock < $newQuantity) {
                    return response()->json([
                        'success' => false,
                        'message' => "Le stock disponible est insuffisant pour commander {$newQuantity} fois ce pack.",
                    ], 400);
                }
            }
            $cart[$key] = $newQuantity;
        } else {
            $cart[$key] = $quantity;
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Pack ajouté au panier',
            'cart_count' => array_sum($cart),
        ]);
    }

    /**
     * Get the stock limit of a pack (minimum stock of its components)
     */
    private function getPackStockLimit($pack)
    {
        if ($pack->products->isEmpty()) {
            return 0;
        }
        return $pack->products->min('stock');
    }
}
