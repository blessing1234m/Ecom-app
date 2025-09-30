<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('admin.profile.edit');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        // Vérifier le mot de passe actuel
        $currentPassword = config('app.admin_password', 'admin123');

        if (!Hash::check($request->current_password, Hash::make($currentPassword))) {
            return back()->withErrors([
                'current_password' => 'Le mot de passe actuel est incorrect.'
            ]);
        }

        // Mettre à jour le mot de passe dans le fichier .env ou la configuration
        $this->updateAdminPassword($request->new_password);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Mot de passe mis à jour avec succès!');
    }

    private function updateAdminPassword(string $newPassword): void
    {
        // Pour une solution simple, nous stockons le mot de passe dans la session
        // En production, vous voudrez peut-être le stocker dans la base de données
        session(['admin_password' => Hash::make($newPassword)]);

        // Optionnel: Vous pouvez aussi mettre à jour un fichier de configuration
        // ou utiliser la base de données pour stocker le mot de passe admin
    }
}
