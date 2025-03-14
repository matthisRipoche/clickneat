<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeManagerController extends Controller
{
    public function index()
    {
        return view('manager.index');
    }
}
