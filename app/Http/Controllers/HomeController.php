<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get active categories with their images and subcategories
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->with(['subcategories' => function($query) {
                $query->where('is_active', true)
                      ->withCount('products')
                      ->orderBy('name');
            }])
            ->orderBy('name')
            ->get();

        // Get active offers
        $offers = Offer::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Get bestsellers - Basé sur les ventes réelles
        // Stratégie: 1 produit de chaque catégorie parmi les plus vendus
        $bestsellers = collect();
        
        // Récupérer les catégories principales
        $categoriesForBestsellers = Category::where('is_active', true)->get();
        
        foreach ($categoriesForBestsellers as $category) {
            // Prendre le produit le plus vendu de cette catégorie
            $product = Product::where('is_active', true)
                ->where('category_id', $category->id)
                ->with('category')
                ->orderBy('total_sales', 'desc')
                ->orderBy('rating', 'desc')
                ->first();
            
            if ($product) {
                $bestsellers->push($product);
            }
            
            // Ajouter un produit pigeon supplémentaire si c'est la catégorie pigeons
            if (stripos($category->name, 'pigeon') !== false) {
                $extraPigeon = Product::where('is_active', true)
                    ->where('category_id', $category->id)
                    ->where('id', '!=', $product->id ?? 0)
                    ->with('category')
                    ->orderBy('total_sales', 'desc')
                    ->orderBy('rating', 'desc')
                    ->first();
                
                if ($extraPigeon) {
                    $bestsellers->push($extraPigeon);
                }
            }
        }
        
        // Compléter avec les produits les plus vendus globalement (aléatoires parmi le top 20)
        if ($bestsellers->count() < 8) {
            $additionalProducts = Product::where('is_active', true)
                ->whereNotIn('id', $bestsellers->pluck('id'))
                ->with('category')
                ->orderBy('total_sales', 'desc')
                ->take(20) // Top 20 des plus vendus
                ->get()
                ->shuffle() // Mélanger aléatoirement
                ->take(8 - $bestsellers->count());
            
            $bestsellers = $bestsellers->merge($additionalProducts);
        }

        // Get new arrivals
        $newArrivals = Product::where('is_active', true)
            ->where('is_new', true)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Get featured products
        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with('category')
            ->orderBy('rating', 'desc')
            ->take(6)
            ->get();

        return view('welcome', compact(
            'categories',
            'offers',
            'bestsellers',
            'newArrivals',
            'featuredProducts'
        ));
    }
}
