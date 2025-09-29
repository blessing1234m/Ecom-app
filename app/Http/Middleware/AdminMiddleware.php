<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Pour l'instant, nous utiliserons une vérification simple
        // Plus tard, vous pourrez intégrer un système d'authentification complet
        if (!$this->isAdmin($request)) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }

    private function isAdmin(Request $request): bool
    {
        // Solution temporaire - vous pouvez changer le mot de passe
        return $request->get('admin_key') === 'ecom2024' ||
               session()->get('is_admin') === true;
    }
}
