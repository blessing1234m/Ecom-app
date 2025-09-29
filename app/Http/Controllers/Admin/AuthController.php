<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required|string'
        ]);

        // Mot de passe temporaire - à changer en production
        if ($request->password === 'admin123') {
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
