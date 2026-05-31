<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Store a new product review
     */
    public function store(Request $request, Order $order, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:3|max:1000',
        ]);

        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== auth()->id()) {
            return back()->with('error', 'Vous n\'êtes pas autorisé à évaluer ce produit.');
        }

        // Ensure the order is delivered
        if ($order->status !== 'delivered') {
            return back()->with('error', 'Vous ne pouvez laisser un avis que pour les commandes livrées.');
        }

        // Ensure the product was part of this order
        $itemExists = $order->items()->where('product_id', $product->id)->exists();
        if (!$itemExists) {
            return back()->with('error', 'Ce produit ne fait pas partie de cette commande.');
        }

        // Prevent double reviews for the same product in the same order
        $exists = Review::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->where('order_id', $order->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Vous avez déjà laissé un avis pour ce produit sur cette commande.');
        }

        // Create review
        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'order_id' => $order->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => true,
        ]);

        // Update product rating and count
        $product->updateRating();

        return back()->with('success', 'Votre avis a été publié avec succès !');
    }
}
