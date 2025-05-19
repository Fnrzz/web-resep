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

    /**
     * Display the landing page with featured recipes
     */
    public function index()
    {
        // Get 8 latest recipes with their ratings
        $featuredRecipes = Recipe::query()
            ->latest()
            ->take(8)
            ->get()
            ->map(function ($recipe) {
                $recipe->rating = $this->ratingController->getRatingByRecipe($recipe->id);
                return $recipe;
            });

        return view('index', compact('featuredRecipes'));
    }

    public function showRecipe($slug)
    {
        $recipe = Recipe::with(['ingredients', 'steps.images'])
                      ->where('slug', $slug)
                      ->firstOrFail();

        return view('detailresep', compact('recipe'));
    }

}
