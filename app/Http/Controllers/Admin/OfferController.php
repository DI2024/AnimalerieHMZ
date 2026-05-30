<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::with('products')->orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();
        
        // Calculate statistics
        $stats = [
            'total' => $offers->count(),
            'active' => $offers->where('is_active', true)->count(),
            'packs' => $offers->where('type', 'pack')->count(),
            'percentage' => $offers->where('type', 'percentage')->count(),
        ];
        
        return view('admin.offers.index', compact('offers', 'stats'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)
            ->with(['category', 'subcategory'])
            ->orderBy('name')
            ->get();
            
        $categories = Category::where('is_active', true)
            ->with(['subcategories' => function($query) {
                $query->where('is_active', true)->orderBy('name');
            }])
            ->orderBy('name')
            ->get();
            
        return view('admin.offers.create', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'bg_color' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'order' => 'required|integer|min:0',
            'type' => 'required|string|in:offer,pack,percentage',
            'pack_price' => 'required_if:type,pack|nullable|numeric|min:0',
            'product_ids' => 'required_if:type,pack|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        // Handle checkbox - convert to boolean
        $validated['is_active'] = $request->has('is_active') && $request->is_active == '1';

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('offers', 'public');
            $validated['image'] = $path;
        }

        if ($validated['type'] !== 'pack') {
            $validated['pack_price'] = null;
        }

        $offer = Offer::create($validated);

        if ($validated['type'] === 'pack') {
            $offer->products()->sync($request->input('product_ids', []));
        } else {
            $offer->products()->sync([]);
        }

        return redirect()->route('admin.offers.index')
            ->with('success', $validated['type'] === 'pack' ? 'Pack créé avec succès!' : 'Offre créée avec succès!');
    }

    public function edit($id)
    {
        $offer = Offer::with('products')->findOrFail($id);
        $products = Product::where('is_active', true)
            ->with(['category', 'subcategory'])
            ->orderBy('name')
            ->get();
            
        $categories = Category::where('is_active', true)
            ->with(['subcategories' => function($query) {
                $query->where('is_active', true)->orderBy('name');
            }])
            ->orderBy('name')
            ->get();
            
        return view('admin.offers.edit', compact('offer', 'products', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'bg_color' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'order' => 'required|integer|min:0',
            'type' => 'required|string|in:offer,pack,percentage',
            'pack_price' => 'required_if:type,pack|nullable|numeric|min:0',
            'product_ids' => 'required_if:type,pack|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        // Handle checkbox - convert to boolean
        $validated['is_active'] = $request->has('is_active') && $request->is_active == '1';

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($offer->image && Storage::disk('public')->exists($offer->image)) {
                Storage::disk('public')->delete($offer->image);
            }
            
            $path = $request->file('image')->store('offers', 'public');
            $validated['image'] = $path;
        }

        if ($validated['type'] !== 'pack') {
            $validated['pack_price'] = null;
        }

        $offer->update($validated);

        if ($validated['type'] === 'pack') {
            $offer->products()->sync($request->input('product_ids', []));
        } else {
            $offer->products()->sync([]);
        }

        return redirect()->route('admin.offers.index')
            ->with('success', $validated['type'] === 'pack' ? 'Pack mis à jour avec succès!' : 'Offre mise à jour avec succès!');
    }

    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        
        // Delete image if exists
        if ($offer->image && Storage::disk('public')->exists($offer->image)) {
            Storage::disk('public')->delete($offer->image);
        }
        
        $offer->delete();

        return redirect()->route('admin.offers.index')
            ->with('success', 'Offre supprimée avec succès!');
    }

    public function toggleStatus($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->is_active = !$offer->is_active;
        $offer->save();

        return redirect()->route('admin.offers.index')
            ->with('success', 'Statut de l\'offre mis à jour!');
    }
}
