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
    $recipes = Recipe::all()->map(function ($recipe) {
        // Gunakan path langsung untuk debugging
        $imagePath = 'thumbnail/' . $recipe->image;
        $fullPath = storage_path('app/public/' . $imagePath);
        
        return [
            'title' => $recipe->title,
            'rating' => 5,
            'image' => file_exists($fullPath) ? asset('storage/' . $imagePath) : null
        ];
    });

    return view('menu', ['recipes' => $recipes]);
}

    
}
