<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'contact_email' => Setting::get('contact_email', 'contact@animaleriehmz.ma'),
            'contact_phone' => Setting::get('contact_phone', '+212 626-911209'),
            'footer_description' => Setting::get('footer_description', 'Animalerie HMZ - Votre boutique en ligne pour tous vos animaux de compagnie au Maroc.'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function updateContact(Request $request)
    {
        $validated = $request->validate([
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:50',
        ]);

        Setting::set('contact_email', $validated['contact_email']);
        Setting::set('contact_phone', $validated['contact_phone']);
        
        return redirect()->route('admin.settings.index')
            ->with('success', 'Informations de contact mises à jour avec succès!');
    }

    public function updateFooter(Request $request)
    {
        $validated = $request->validate([
            'footer_description' => 'required|string|max:500',
        ]);

        Setting::set('footer_description', $validated['footer_description']);
        
        return redirect()->route('admin.settings.index')
            ->with('success', 'Texte du footer mis à jour avec succès!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('admin.settings.index')
                ->with('error', 'Le mot de passe actuel est incorrect.');
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Log out the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to login with success message
        return redirect()->route('login')
            ->with('success', 'Mot de passe mis à jour avec succès! Veuillez vous reconnecter.');
    }
}
