<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function index()
    {
        // if not login redirect to login 
        // else redirect to home view user or restaurateur


        return view('entry.index');
    }
}
