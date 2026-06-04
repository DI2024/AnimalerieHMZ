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

        $allPacks = Offer::where('type', 'pack')->where('is_active', true)->orderBy('title')->get();
        $allOffers = Offer::where('type', '!=', 'pack')->where('is_active', true)->orderBy('title')->get();

        // 1. Filter by Pack
        if ($request->filled('is_pack')) {
            $packQuery = Offer::where('type', 'pack')
                ->where('is_active', true)
                ->with('products');

            if ($request->filled('pack_id')) {
                $packQuery->where('id', $request->pack_id);
            }

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
                $virtualProduct->link = route('packs.show', $pack->id);
                
                // Set virtual category
                $categoryObj = new Category();
                $categoryObj->name = 'Pack Spécial';
                $virtualProduct->setRelation('category', $categoryObj);

                return $virtualProduct;
            });

            return view('client.products.index', compact('products', 'categories', 'allPacks', 'allOffers'));
        }

        // 2. Filter by Offer (excluing packs)
        if ($request->filled('is_offer')) {
            $offerQuery = Offer::where('type', '!=', 'pack')
                ->where('is_active', true)
                ->with('products');

            if ($request->filled('offer_id')) {
                $offerQuery->where('id', $request->offer_id);
            }

            if ($request->filled('search')) {
                $search = $request->search;
                $offerQuery->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('subtitle', 'like', "%{$search}%");
                });
            }

            $offers = $offerQuery->paginate(12)->withQueryString();

            // Transform each offer to mimic a Product object so the Blade template displays it correctly
            $products = $offers->through(function ($offer) {
                $virtualProduct = new Product();
                $virtualProduct->id = $offer->id;
                $virtualProduct->name = $offer->title;
                $virtualProduct->slug = null; // No slug for offers, we handle it in blade
                $virtualProduct->description = $offer->subtitle;
                $virtualProduct->price = 0.0; // Standard offers don't have a unique price, they group products
                $virtualProduct->old_price = 0.0;
                
                // Process image path
                $imageUrl = $offer->image 
                    ? (filter_var($offer->image, FILTER_VALIDATE_URL) ? $offer->image : 'storage/' . $offer->image)
                    : 'images/placeholder.svg';
                $virtualProduct->image = $imageUrl;
                
                $virtualProduct->is_active = $offer->is_active;
                $virtualProduct->is_new = false;
                $virtualProduct->is_bestseller = false;
                $virtualProduct->rating = 5.0;
                $virtualProduct->is_offer = true; // Flag for blade
                $virtualProduct->link = route('offers.show', $offer->id);
                
                // Set virtual category
                $categoryObj = new Category();
                $categoryObj->name = 'Offre Spéciale';
                $virtualProduct->setRelation('category', $categoryObj);

                return $virtualProduct;
            });

            return view('client.products.index', compact('products', 'categories', 'allPacks', 'allOffers'));
        }

        // 3. Filter by standard products
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

        return view('client.products.index', compact('products', 'categories', 'allPacks', 'allOffers'));
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

    public function showPack($id)
    {
        $pack = Offer::where('type', 'pack')
            ->where('is_active', true)
            ->with('products')
            ->findOrFail($id);

        $breadcrumbs = [
            ['name' => 'Accueil', 'url' => route('home')],
            ['name' => 'Packs Spéciaux', 'url' => route('products.index', ['is_pack' => 1])],
            ['name' => $pack->title, 'url' => null],
        ];

        return view('client.packs.show', compact('pack', 'breadcrumbs'));
    }

    public function showOffer($id)
    {
        $offer = Offer::where('type', '!=', 'pack')
            ->where('is_active', true)
            ->with('products')
            ->findOrFail($id);

        $breadcrumbs = [
            ['name' => 'Accueil', 'url' => route('home')],
            ['name' => 'Offres Spéciales', 'url' => route('products.index', ['is_offer' => 1])],
            ['name' => $offer->title, 'url' => null],
        ];

        return view('client.offers.show', compact('offer', 'breadcrumbs'));
    }

    // API endpoint for AJAX requests
    public function apiIndex(Request $request)
    {
        if ($request->filled('is_pack')) {
            $packQuery = Offer::where('type', 'pack')
                ->where('is_active', true)
                ->with('products');

            if ($request->filled('pack_id')) {
                $packQuery->where('id', $request->pack_id);
            }

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
                    'link' => route('packs.show', $pack->id),
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

        if ($request->filled('is_offer')) {
            $offerQuery = Offer::where('type', '!=', 'pack')
                ->where('is_active', true)
                ->with('products');

            if ($request->filled('offer_id')) {
                $offerQuery->where('id', $request->offer_id);
            }

            if ($request->filled('search')) {
                $search = $request->search;
                $offerQuery->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('subtitle', 'like', "%{$search}%");
                });
            }

            $offers = $offerQuery->get();

            $products = $offers->map(function ($offer) {
                $imageUrl = $offer->image 
                    ? (filter_var($offer->image, FILTER_VALIDATE_URL) ? $offer->image : 'storage/' . $offer->image)
                    : 'images/placeholder.svg';
                return [
                    'id' => $offer->id,
                    'name' => $offer->title,
                    'slug' => null,
                    'price' => 0.0,
                    'old_price' => 0.0,
                    'image' => $imageUrl,
                    'is_offer' => true,
                    'link' => route('offers.show', $offer->id),
                    'category' => ['name' => 'Offre Spéciale'],
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
