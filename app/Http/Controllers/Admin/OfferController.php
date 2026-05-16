<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::orderBy('created_at', 'desc')->get();
        return view('admin.offers.index', compact('offers'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)
            ->orderBy('name')
            ->get();
            
        return view('admin.offers.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'nullable|string|max:255',
            'bg_color' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('offers', 'public');
            $validated['image'] = $path;
        }

        Offer::create($validated);

        return redirect()->route('admin.offers.index')
            ->with('success', 'Offre créée avec succès!');
    }

    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $products = Product::where('is_active', true)
            ->orderBy('name')
            ->get();
            
        return view('admin.offers.edit', compact('offer', 'products'));
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'nullable|string|max:255',
            'bg_color' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($offer->image && Storage::disk('public')->exists($offer->image)) {
                Storage::disk('public')->delete($offer->image);
            }
            
            $path = $request->file('image')->store('offers', 'public');
            $validated['image'] = $path;
        }

        $offer->update($validated);

        return redirect()->route('admin.offers.index')
            ->with('success', 'Offre mise à jour avec succès!');
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
