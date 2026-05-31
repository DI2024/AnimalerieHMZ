<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Offer;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Load categories with their subcategories and product counts
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->with(['subcategories' => function($query) {
                $query->where('is_active', true)
                      ->withCount('products')
                      ->orderBy('name');
            }])
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        if ($request->filled('is_pack')) {
            $packQuery = Offer::where('type', 'pack')
                ->where('is_active', true)
                ->with('products');

            if ($request->filled('search')) {
                $search = $request->search;
                $packQuery->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('subtitle', 'like', "%{$search}%");
                });
            }

            if ($request->filled('min_price')) {
                $packQuery->where('pack_price', '>=', $request->min_price);
            }
            if ($request->filled('max_price')) {
                $packQuery->where('pack_price', '<=', $request->max_price);
            }

            $packs = $packQuery->paginate(12)->withQueryString();

            // Transform each pack to mimic a Product object so the Blade template displays it correctly
            $products = $packs->through(function ($pack) {
                $virtualProduct = new Product();
                $virtualProduct->id = $pack->id;
                $virtualProduct->name = $pack->title;
                $virtualProduct->slug = null; // No slug for packs, we handle it in blade
                $virtualProduct->description = $pack->subtitle;
                $virtualProduct->price = $pack->pack_price;
                $virtualProduct->old_price = $pack->total_original_price;
                
                // Process image path
                $imageUrl = $pack->image 
                    ? (filter_var($pack->image, FILTER_VALIDATE_URL) ? $pack->image : 'storage/' . $pack->image)
                    : 'images/placeholder.svg';
                $virtualProduct->image = $imageUrl;
                
                $virtualProduct->is_active = $pack->is_active;
                $virtualProduct->is_new = false;
                $virtualProduct->is_bestseller = false;
                $virtualProduct->rating = 5.0; // Packs get a virtual 5-star rating
                $virtualProduct->is_pack = true; // Flag for blade
                $virtualProduct->link = $pack->link ?: route('home'); // Redirection link
                
                // Set virtual category
                $categoryObj = new Category();
                $categoryObj->name = 'Pack Spécial';
                $virtualProduct->setRelation('category', $categoryObj);

                return $virtualProduct;
            });

            return view('client.products.index', compact('products', 'categories'));
        }

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
        
        // Si aucun filtre de catégorie/sous-catégorie et tri par défaut, afficher aléatoirement
        if (!$request->filled('category') && !$request->filled('subcategory') && $sortBy == 'created_at') {
            $query->inRandomOrder();
        } else {
            // Sinon, appliquer le tri normal
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
        }

        $products = $query->paginate(12)->withQueryString();

        return view('client.products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'subcategory', 'reviews' => function($query) {
                $query->where('is_approved', true)->with('user')->latest();
            }])
            ->firstOrFail();

        // Get related products (same category, different product)
        $relatedProducts = Product::where('is_active', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('category')
            ->take(8)
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
        if ($request->filled('is_pack')) {
            $packQuery = Offer::where('type', 'pack')
                ->where('is_active', true)
                ->with('products');

            if ($request->filled('search')) {
                $search = $request->search;
                $packQuery->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('subtitle', 'like', "%{$search}%");
                });
            }

            $packs = $packQuery->get();

            $products = $packs->map(function ($pack) {
                $imageUrl = $pack->image 
                    ? (filter_var($pack->image, FILTER_VALIDATE_URL) ? $pack->image : 'storage/' . $pack->image)
                    : 'images/placeholder.svg';
                return [
                    'id' => $pack->id,
                    'name' => $pack->title,
                    'slug' => null,
                    'price' => (float)$pack->pack_price,
                    'old_price' => (float)$pack->total_original_price,
                    'image' => $imageUrl,
                    'is_pack' => true,
                    'link' => $pack->link ?: route('home'),
                    'category' => ['name' => 'Pack Spécial'],
                    'rating' => 5.0,
                    'is_new' => false,
                    'is_bestseller' => false
                ];
            });

            return response()->json([
                'success' => true,
                'products' => $products,
                'count' => $products->count(),
            ]);
        }

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
                $query->where('is_active', true)
                      ->orderBy('name');
            }])
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'categories' => $categories,
        ]);
    }
}
