<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Utiliser le guard 'admin' pour vérifier l'authentification
        if (!Auth::guard('admin')->check()) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }

}
