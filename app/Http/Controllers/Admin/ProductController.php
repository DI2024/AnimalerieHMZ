<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'subcategory']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by categories (multiple)
        if ($request->filled('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        // Filter by price range
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Filter by stock status (multiple)
        if ($request->filled('stock')) {
            $stockFilters = $request->stock;
            $query->where(function($q) use ($stockFilters) {
                foreach ($stockFilters as $stockFilter) {
                    if ($stockFilter === 'in_stock') {
                        $q->orWhere('stock', '>', 10);
                    } elseif ($stockFilter === 'low_stock') {
                        $q->orWhere(function($subQ) {
                            $subQ->where('stock', '>', 0)->where('stock', '<=', 10);
                        });
                    } elseif ($stockFilter === 'out_of_stock') {
                        $q->orWhere('stock', 0);
                    }
                }
            });
        }

        // Filter by badges (multiple)
        if ($request->filled('badges')) {
            $badges = $request->badges;
            $query->where(function($q) use ($badges) {
                foreach ($badges as $badge) {
                    if ($badge === 'new') {
                        $q->orWhere('is_new', 1);
                    } elseif ($badge === 'bestseller') {
                        $q->orWhere('is_bestseller', 1);
                    } elseif ($badge === 'featured') {
                        $q->orWhere('is_featured', 1);
                    }
                }
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', 1);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', 0);
            }
        }

        // Sorting
        if ($request->filled('sort')) {
            $sort = $request->sort;
            switch ($sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'stock_asc':
                    $query->orderBy('stock', 'asc');
                    break;
                case 'stock_desc':
                    $query->orderBy('stock', 'desc');
                    break;
                case 'created_desc':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Pagination
        $products = $query->paginate(12)->withQueryString();

        // Get categories with product counts
        $categories = Category::withCount('products')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $subcategories = SubCategory::where('is_active', true)->get();
        
        return view('admin.products.create', compact('categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'price_old' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
            'is_new' => 'boolean',
            'is_bestseller' => 'boolean',
            'is_featured' => 'boolean',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        // Calculate discount percentage if not provided
        if (!isset($validated['discount_percentage']) && isset($validated['price_old']) && $validated['price_old'] > 0) {
            $validated['discount_percentage'] = round((($validated['price_old'] - $validated['price']) / $validated['price_old']) * 100);
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit créé avec succès!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('is_active', true)->get();
        $subcategories = SubCategory::where('is_active', true)->get();
        
        return view('admin.products.edit', compact('product', 'categories', 'subcategories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'price_old' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
        ]);

        // Handle checkboxes - convert to boolean
        $validated['is_active'] = $request->has('is_active') && $request->is_active == '1' ? 1 : 0;
        $validated['is_new'] = $request->has('is_new') && $request->is_new == '1' ? 1 : 0;
        $validated['is_bestseller'] = $request->has('is_bestseller') && $request->is_bestseller == '1' ? 1 : 0;
        $validated['is_featured'] = $request->has('is_featured') && $request->is_featured == '1' ? 1 : 0;

        // Update slug if name changed
        if ($validated['name'] !== $product->name) {
            $validated['slug'] = Str::slug($validated['name']);
            
            // Ensure unique slug
            $originalSlug = $validated['slug'];
            $count = 1;
            while (Product::where('slug', $validated['slug'])->where('id', '!=', $id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        // Calculate discount percentage if not provided
        if (!isset($validated['discount_percentage']) && isset($validated['price_old']) && $validated['price_old'] > 0) {
            $validated['discount_percentage'] = round((($validated['price_old'] - $validated['price']) / $validated['price_old']) * 100);
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit mis à jour avec succès!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Delete image if exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit supprimé avec succès!');
    }

    // API endpoint for getting subcategories by category
    public function getSubcategories($categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)
            ->where('is_active', true)
            ->get();
        
        return response()->json($subcategories);
    }

    // Bulk actions
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'products' => 'required|array',
            'products.*' => 'exists:products,id'
        ]);

        $productIds = $validated['products'];
        $action = $validated['action'];

        switch ($action) {
            case 'activate':
                Product::whereIn('id', $productIds)->update(['is_active' => true]);
                $message = count($productIds) . ' produit(s) activé(s) avec succès!';
                break;
            
            case 'deactivate':
                Product::whereIn('id', $productIds)->update(['is_active' => false]);
                $message = count($productIds) . ' produit(s) désactivé(s) avec succès!';
                break;
            
            case 'delete':
                $products = Product::whereIn('id', $productIds)->get();
                foreach ($products as $product) {
                    // Delete image if exists
                    if ($product->image && Storage::disk('public')->exists($product->image)) {
                        Storage::disk('public')->delete($product->image);
                    }
                    $product->delete();
                }
                $message = count($productIds) . ' produit(s) supprimé(s) avec succès!';
                break;
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    // Update stock inline
    public function updateStock(Request $request, $id)
    {
        $validated = $request->validate([
            'stock' => 'required|integer|min:0'
        ]);

        $product = Product::findOrFail($id);
        $product->update(['stock' => $validated['stock']]);

        return response()->json([
            'success' => true,
            'message' => 'Stock mis à jour avec succès!',
            'stock' => $product->stock
        ]);
    }

    // Quick view
    public function quickView($id)
    {
        $product = Product::with(['category', 'subcategory', 'orderItems'])->findOrFail($id);
        
        return view('admin.products.partials.quick-view', compact('product'));
    }

    // Toggle product status
    public function toggleStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'is_active' => 'required|boolean'
        ]);

        $product = Product::findOrFail($id);
        $product->update(['is_active' => $validated['is_active']]);

        return response()->json([
            'success' => true,
            'message' => 'Statut mis à jour avec succès!',
            'is_active' => $product->is_active
        ]);
    }
}
