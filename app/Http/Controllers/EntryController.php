<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{

    /**
     * Redirige l'utilisateur connecté vers la page correspondant à son rôle.
     *
     * - Si l'utilisateur n'est pas connecté, il est redirigé vers la page de login.
     * - Si le rôle est "manager", redirection vers la page manager.
     * - Si le rôle est "admin", redirection vers le dashboard admin.
     * - Sinon, redirection vers la page d'accueil utilisateur.
     *
     * @return \Illuminate\Http\RedirectResponse La redirection appropriée selon le rôle ou la connexion
     */
    public function checkRole()
    {
        // Si l'utilisateur n'est pas authentifié → redirection vers login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Redirection selon le rôle de l'utilisateur connecté
        if (Auth::user()->role === 'manager') {
            return redirect()->route('manager.index');
        }

        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard.index');
        }

        // Redirection par défaut pour les utilisateurs "simples"
        return redirect()->route('home_user.index');
    }
}
