<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role === 'manager') {
            return redirect()->route('home_manager.index');
        }

        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('home_user.index');
    }
}
