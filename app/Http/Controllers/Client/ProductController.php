<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->with(['category', 'subcategory']);

        // Filter by category
        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Filter by subcategory
        if ($request->filled('subcategory')) {
            $subcategory = SubCategory::where('slug', $request->subcategory)->first();
            if ($subcategory) {
                $query->where('subcategory_id', $subcategory->id);
            }
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by flags
        if ($request->filled('is_new')) {
            $query->where('is_new', true);
        }
        if ($request->filled('is_bestseller')) {
            $query->where('is_bestseller', true);
        }

        // Sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        
        switch ($sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->get();

        return view('client.products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'subcategory'])
            ->firstOrFail();

        // Get related products (same category, different product)
        $relatedProducts = Product::where('is_active', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('category')
            ->take(4)
            ->get();

        // Build breadcrumbs
        $breadcrumbs = [
            ['name' => 'Accueil', 'url' => route('home')],
            ['name' => $product->category->name, 'url' => route('products.index', ['category' => $product->category->slug])],
            ['name' => $product->name, 'url' => null],
        ];

        return view('client.products.show', compact('product', 'relatedProducts', 'breadcrumbs'));
    }

    // API endpoint for AJAX requests
    public function apiIndex(Request $request)
    {
        $query = Product::where('is_active', true)->with(['category', 'subcategory']);

        // Filter by category slug
        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Filter by subcategory
        if ($request->filled('subcategory')) {
            $query->where('subcategory_id', $request->subcategory);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by flags
        if ($request->filled('is_bestseller')) {
            $query->where('is_bestseller', true);
        }
        if ($request->filled('is_new')) {
            $query->where('is_new', true);
        }
        if ($request->filled('is_featured')) {
            $query->where('is_featured', true);
        }

        // Sorting
        $sortBy = $request->get('sort', 'created_at');
        switch ($sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $products = $query->get();

        return response()->json([
            'success' => true,
            'products' => $products,
            'count' => $products->count(),
        ]);
    }

    // API endpoint for single product
    public function apiShow($id)
    {
        $product = Product::where('is_active', true)
            ->with(['category', 'subcategory'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'product' => $product,
        ]);
    }

    // API endpoint for categories
    public function apiCategories()
    {
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->with(['subcategories' => function($query) {
                $query->where('is_active', true);
            }])
            ->get();

        return response()->json([
            'success' => true,
            'categories' => $categories,
        ]);
    }
}
