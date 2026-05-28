<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use App\Models\HeroSlide;
use App\Models\Testimonial;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share settings with all views
        View::composer('*', function ($view) {
            $view->with('siteSettings', [
                'contact_email' => Setting::get('contact_email', 'contact@animaleriehmz.ma'),
                'contact_phone' => Setting::get('contact_phone', '+212 626-911209'),
                'footer_description' => Setting::get('footer_description', 'Animalerie HMZ - Votre boutique en ligne pour tous vos animaux de compagnie au Maroc.'),
                'footer_copyright' => Setting::get('footer_copyright', '© 2024 Animalerie HMZ. Tous droits réservés.'),
                'social_facebook' => Setting::get('social_facebook', 'https://www.facebook.com'),
                'social_instagram' => Setting::get('social_instagram', 'https://www.instagram.com'),
                'social_whatsapp' => Setting::get('social_whatsapp', 'https://wa.me/212626911209'),
            ]);
        });
        
        // Share hero slides and testimonials with welcome page
        View::composer('welcome', function ($view) {
            $view->with([
                'heroSlides' => HeroSlide::where('is_active', true)->orderBy('order')->take(3)->get(), // Max 3 slides
                'testimonials' => Testimonial::where('is_active', true)->orderBy('order')->take(3)->get(),
            ]);
        });
    }
}
