<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['products', 'subcategories'])
            ->orderBy('order')
            ->orderBy('name')
            ->get();
        
        // Calculate stats
        $stats = [
            'total' => $categories->count(),
            'active' => $categories->where('is_active', 1)->count(),
            'inactive' => $categories->where('is_active', 0)->count(),
            'total_products' => $categories->sum('products_count'),
        ];
            
        return view('admin.categories.index', compact('categories', 'stats'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Category::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = $path;
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie créée avec succès!');
    }

    public function edit($id)
    {
        $category = Category::with('subcategories')->findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle checkbox - convert to boolean
        $validated['is_active'] = $request->has('is_active') && $request->is_active == '1' ? 1 : 0;

        // Update slug if name changed
        if ($validated['name'] !== $category->name) {
            $validated['slug'] = Str::slug($validated['name']);
            
            $originalSlug = $validated['slug'];
            $count = 1;
            while (Category::where('slug', $validated['slug'])->where('id', '!=', $id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Handle image removal
        if ($request->input('remove_image') == '1') {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = null;
        }
        // Handle image upload
        elseif ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = $path;
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie mise à jour avec succès!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // Check if category has products
        if ($category->products()->count() > 0) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Impossible de supprimer une catégorie contenant des produits!'
                ], 400);
            }
            return redirect()->route('admin.categories.index')
                ->with('error', 'Impossible de supprimer une catégorie contenant des produits!');
        }
        
        // Delete image if exists
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }
        
        $category->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Catégorie supprimée avec succès!'
            ]);
        }
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée avec succès!');
    }

    public function quickView($id)
    {
        $category = Category::withCount('products')->findOrFail($id);
        
        // Format image URL
        if ($category->image) {
            if (!filter_var($category->image, FILTER_VALIDATE_URL)) {
                $category->image = asset('storage/' . $category->image);
            }
        }
        
        // Set order to display value (1-based index instead of 0-based)
        // If order field doesn't exist, use id as fallback
        if (!isset($category->order)) {
            $category->order = $category->id;
        }
        
        return response()->json([
            'success' => true,
            'category' => $category
        ]);
    }

    public function reorder(Request $request)
    {
        $categories = $request->input('categories');
        
        foreach ($categories as $categoryData) {
            Category::where('id', $categoryData['id'])
                ->update(['order' => $categoryData['order']]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Ordre enregistré avec succès!'
        ]);
    }

    // Subcategory methods
    public function storeSubcategory(Request $request, $categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['category_id'] = $categoryId;
        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $count = 1;
        while (SubCategory::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('subcategories', 'public');
            $validated['image'] = $path;
        }

        SubCategory::create($validated);

        return redirect()->route('admin.categories.edit', $categoryId)
            ->with('success', 'Sous-catégorie créée avec succès!');
    }

    public function updateSubcategory(Request $request, $categoryId, $subcategoryId)
    {
        $subcategory = SubCategory::where('category_id', $categoryId)
            ->findOrFail($subcategoryId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        // Update slug if name changed
        if ($validated['name'] !== $subcategory->name) {
            $validated['slug'] = Str::slug($validated['name']);
            
            $originalSlug = $validated['slug'];
            $count = 1;
            while (SubCategory::where('slug', $validated['slug'])->where('id', '!=', $subcategoryId)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($subcategory->image && Storage::disk('public')->exists($subcategory->image)) {
                Storage::disk('public')->delete($subcategory->image);
            }
            
            $path = $request->file('image')->store('subcategories', 'public');
            $validated['image'] = $path;
        }

        $subcategory->update($validated);

        return redirect()->route('admin.categories.edit', $categoryId)
            ->with('success', 'Sous-catégorie mise à jour avec succès!');
    }

    public function destroySubcategory($categoryId, $subcategoryId)
    {
        $subcategory = SubCategory::where('category_id', $categoryId)
            ->findOrFail($subcategoryId);
        
        // Check if subcategory has products
        if ($subcategory->products()->count() > 0) {
            return redirect()->route('admin.categories.edit', $categoryId)
                ->with('error', 'Impossible de supprimer une sous-catégorie contenant des produits!');
        }
        
        // Delete image if exists
        if ($subcategory->image && Storage::disk('public')->exists($subcategory->image)) {
            Storage::disk('public')->delete($subcategory->image);
        }
        
        $subcategory->delete();

        return redirect()->route('admin.categories.edit', $categoryId)
            ->with('success', 'Sous-catégorie supprimée avec succès!');
    }
}
