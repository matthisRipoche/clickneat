<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.users.index', [
            'users' => User::all()
        ]);
    }

    public function show($id)
    {
        $user = User::with('orders')->findOrFail($id);

        return view('dashboard.users.show', [
            'user' => $user
        ]);
    }
}
