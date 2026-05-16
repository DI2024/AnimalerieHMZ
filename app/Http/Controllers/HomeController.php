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
        // Get active categories with their images
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->orderBy('name')
            ->get();

        // Get active offers
        $offers = Offer::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Get bestsellers
        $bestsellers = Product::where('is_active', true)
            ->where('is_bestseller', true)
            ->with('category')
            ->orderBy('rating', 'desc')
            ->take(6)
            ->get();

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
