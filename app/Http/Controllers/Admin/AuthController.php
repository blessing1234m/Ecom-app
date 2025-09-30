<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required|string'
        ]);

        // Vérifier le mot de passe
        $storedPassword = session('admin_password');
        $defaultPassword = 'admin123';

        if ($storedPassword) {
            // Vérifier le mot de passe hashé
            $isValid = Hash::check($request->password, $storedPassword);
        } else {
            // Vérifier le mot de passe par défaut
            $isValid = Hash::check($request->password, Hash::make($defaultPassword));
        }

        if ($isValid) {
            session(['is_admin' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'password' => 'Mot de passe incorrect.'
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        session()->forget('is_admin');
        return redirect()->route('admin.login');
    }
}
