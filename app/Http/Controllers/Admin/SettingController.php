<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function updateContact(Request $request)
    {
        $validated = $request->validate([
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:50',
        ]);

        // TODO: Save to settings table when created
        // For now, just show success message
        
        return redirect()->route('admin.settings.index')
            ->with('success', 'Informations de contact mises à jour avec succès!');
    }

    public function updateFooter(Request $request)
    {
        $validated = $request->validate([
            'footer_description' => 'required|string|max:500',
            'footer_copyright' => 'required|string|max:255',
        ]);

        // TODO: Save to settings table when created
        // For now, just show success message
        
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

        return redirect()->route('admin.settings.index')
            ->with('success', 'Mot de passe mis à jour avec succès!');
    }
}
