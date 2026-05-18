<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    public function index()
    {
        $heroSlides = HeroSlide::orderBy('order')->get();
        $testimonials = Testimonial::orderBy('order')->get();
        
        return view('admin.sections.index', compact('heroSlides', 'testimonials'));
    }

    // Hero Slides Management
    public function heroIndex()
    {
        $slides = HeroSlide::orderBy('order')->get();
        return view('admin.sections.hero.index', compact('slides'));
    }

    public function heroCreate()
    {
        return view('admin.sections.hero.create');
    }

    public function heroStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('hero_slides', 'public');
        }

        HeroSlide::create($validated);

        return redirect()->route('admin.sections.hero.index')
            ->with('success', 'Hero slide created successfully!');
    }

    public function heroEdit(HeroSlide $slide)
    {
        return view('admin.sections.hero.edit', compact('slide'));
    }

    public function heroUpdate(Request $request, HeroSlide $slide)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($slide->image && Storage::disk('public')->exists($slide->image)) {
                Storage::disk('public')->delete($slide->image);
            }
            $validated['image'] = $request->file('image')->store('hero_slides', 'public');
        }

        $slide->update($validated);

        return redirect()->route('admin.sections.hero.index')
            ->with('success', 'Hero slide updated successfully!');
    }

    public function heroDestroy(HeroSlide $slide)
    {
        // Delete image
        if ($slide->image && Storage::disk('public')->exists($slide->image)) {
            Storage::disk('public')->delete($slide->image);
        }

        $slide->delete();

        return redirect()->route('admin.sections.hero.index')
            ->with('success', 'Hero slide deleted successfully!');
    }

    // Testimonials Management
    public function testimonialIndex()
    {
        $testimonials = Testimonial::orderBy('order')->get();
        return view('admin.sections.testimonials.index', compact('testimonials'));
    }

    public function testimonialCreate()
    {
        return view('admin.sections.testimonials.create');
    }

    public function testimonialStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'content' => 'required|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.sections.testimonials.index')
            ->with('success', 'Testimonial created successfully!');
    }

    public function testimonialEdit(Testimonial $testimonial)
    {
        return view('admin.sections.testimonials.edit', compact('testimonial'));
    }

    public function testimonialUpdate(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'content' => 'required|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($testimonial->avatar && Storage::disk('public')->exists($testimonial->avatar)) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.sections.testimonials.index')
            ->with('success', 'Testimonial updated successfully!');
    }

    public function testimonialDestroy(Testimonial $testimonial)
    {
        // Delete avatar
        if ($testimonial->avatar && Storage::disk('public')->exists($testimonial->avatar)) {
            Storage::disk('public')->delete($testimonial->avatar);
        }

        $testimonial->delete();

        return redirect()->route('admin.sections.testimonials.index')
            ->with('success', 'Testimonial deleted successfully!');
    }
    
    public function testimonialToggleStatus(Testimonial $testimonial)
    {
        $testimonial->is_active = !$testimonial->is_active;
        $testimonial->save();

        return redirect()->route('admin.sections.testimonials.index')
            ->with('success', 'Testimonial status updated successfully!');
    }
}
