<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    protected $ratingController;
    public function __construct(RatingController $ratingController)
    {
        $this->ratingController = $ratingController;
    }
    public function tanyaAI()
    {
        return view('ai');
    }
    public function menu()
    {
        $recipes = Recipe::select('id', 'title', 'slug', 'image')->get();
        $data = $recipes->map(function ($recipe) {
            return [
                'title' => $recipe->title,
                'slug' => $recipe->slug,
                'image' => $recipe->image,
                'rating' => $this->ratingController->getRatingByRecipe($recipe->id)
            ];
        });
        return view('menu', compact('data'));
    }
}
