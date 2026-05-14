<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    public function index()
    {
        // Mock categories
        $categories = collect([
            (object)['id' => 1, 'name' => 'Chiens', 'products_count' => 45],
            (object)['id' => 2, 'name' => 'Chats', 'products_count' => 38],
            (object)['id' => 3, 'name' => 'Oiseaux', 'products_count' => 12],
        ]);

        // Mock products
        $allProducts = collect();
        for ($i = 1; $i <= 20; $i++) {
            $allProducts->push((object)[
                'id' => $i,
                'name' => "Produit Premium $i",
                'slug' => "produit-premium-$i",
                'price' => rand(50, 500),
                'price_old' => rand(550, 700),
                'stock' => rand(0, 50),
                'category' => $categories->random(),
                'is_active' => (bool)rand(0, 1),
                'is_new' => (bool)rand(0, 1),
                'is_bestseller' => (bool)rand(0, 1),
                'is_featured' => (bool)rand(0, 1),
                'discount_percentage' => rand(0, 30),
                'rating' => rand(3, 5),
                'review_count' => rand(0, 50),
                'image' => null,
                'badge' => null,
                'created_at' => now()->subDays(rand(1, 30)),
                'orderItems' => collect([]), // Mock for sales count
                'images' => collect([]), // Mock for gallery
            ]);
        }


        // Simple pagination mock
        $currentPage = 1;
        $perPage = 10;
        $products = new LengthAwarePaginator(
            $allProducts->forPage($currentPage, $perPage),
            $allProducts->count(),
            $perPage,
            $currentPage,
            ['path' => route('admin.products.index')]
        );

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function edit($id)
    {
        return view('admin.products.edit');
    }
}
