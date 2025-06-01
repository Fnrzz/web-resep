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
    public function menu(Request $request)
    {
        if ($request->has('search')) {
            $data = Recipe::query()
                ->where('title', 'like', '%' . $request->search . '%')
                ->get()
                ->map(function ($recipe) {
                    $recipe->rating = $this->ratingController->getRatingByRecipe($recipe->id);
                    return $recipe;
                });
        } else {
            $data = Recipe::query()
                ->latest()
                ->get()
                ->map(function ($recipe) {
                    $recipe->rating = $this->ratingController->getRatingByRecipe($recipe->id);
                    return $recipe;
                });
        }
        return view('menu', compact('data'));
    }


    public function index()
    {
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

        $recipe->rating = $this->ratingController->getRatingByRecipe($recipe->id);

        confirmDelete('Kamu yakin?', 'Kamu akan menghapus resep ini dari favorit');
        return view('detailresep', compact('recipe'));
    }
}
