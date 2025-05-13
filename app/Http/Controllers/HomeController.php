<?php

namespace App\Http\Controllers;
use App\Models\Recipe;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function tanyaAI()
    {
        return view('ai');
    }
    public function menu()
{
    $recipes = Recipe::all();
    return view('menu', compact('recipes'));
}

    
}
